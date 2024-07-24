from flask import Flask, render_template, request, jsonify, redirect, url_for, Response
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import load_img, img_to_array
import numpy as np
import os
from PIL import Image
from flask_cors import CORS
import threading
import logging
import cv2
import gradio as gr
import uuid

app = Flask(__name__)
CORS(app)

# Set up logging
logging.basicConfig(level=logging.DEBUG)

# Load the model
model_path = "updates_models_segmented_augmenteds.keras"
if os.path.exists(model_path):
    try:
        model = load_model(model_path)
        logging.info(f"Model loaded successfully from {model_path}")
    except Exception as e:
        logging.error(f"Error loading model: {e}")
else:
    raise ValueError(f"File not found: {model_path}. Please ensure the file is an accessible `.keras` file.")

UPLOAD_FOLDER = 'static/uploads/'
PREDICTION_FOLDER = 'static/predictions/'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg', 'gif', 'tiff', 'webp', 'jfif'}

# Create directories if not exist
if not os.path.exists(PREDICTION_FOLDER):
    os.makedirs(PREDICTION_FOLDER)
    os.makedirs(os.path.join(PREDICTION_FOLDER, 'organik'))
    os.makedirs(os.path.join(PREDICTION_FOLDER, 'anorganik'))

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

def preprocess_image(img_path):
    try:
        logging.debug(f"Preprocessing image from path: {img_path}")
        img = load_img(img_path, target_size=(224, 224))
        x = img_to_array(img)
        logging.debug(f"Image shape before normalization: {x.shape}")
        x = x * 2.0 / 255.0  # Normalize image as per new data augmentation
        x = np.expand_dims(x, axis=0)
        logging.debug(f"Image shape after preprocessing: {x.shape}")
        return x
    except Exception as e:
        logging.error(f"Error in image preprocessing: {e}")
        return None

def preprocess_camera_image(image):
    try:
        logging.debug(f"Preprocessing camera image")
        image = cv2.resize(image, (224, 224))
        x = img_to_array(image)
        logging.debug(f"Camera image shape before normalization: {x.shape}")
        x = x * 2.0 / 255.0  # Normalize image
        x = np.expand_dims(x, axis=0)
        logging.debug(f"Camera image shape after preprocessing: {x.shape}")
        return x
    except Exception as e:
        logging.error(f"Error in camera image preprocessing: {e}")
        return None

def save_and_preprocess_image(file, filename):
    try:
        file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
        img_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        img = Image.open(img_path).convert('RGB')
        img = img.resize((224, 224))  # Resize image to match model input
        img.save(img_path, format="JPEG")
        return preprocess_image(img_path)
    except Exception as e:
        logging.error(f"Error saving and preprocessing image: {e}")
        return None

@app.route("/", methods=['GET'])
def home():
    return render_template("home.php")

@app.route("/education", methods=['GET'])
def education():
    return render_template("education.php")

@app.route("/classifications", methods=['GET'])
def classification():
    return render_template("classifications.php")

@app.route('/submit', methods=['POST'])
def predict():
    if 'file' not in request.files:
        return jsonify({'message': 'No image in the request'}), 400
    
    files = request.files.getlist('file')
    filename = "temp_image.jpg"
    for file in files:
        if file and allowed_file(file.filename):
            x = save_and_preprocess_image(file, filename)
            if x is None:
                return jsonify({'message': 'Error processing the image'}), 400
            
            try:
                logging.debug("Making prediction")
                prediction = model.predict(x)
                logging.info(f"Prediction shape: {prediction.shape}")
                logging.info(f"Prediction values: {prediction}")

                class_names = ['organik', 'anorganik']
                confidence_organik, confidence_anorganik = "N/A", "N/A"
                
                if prediction.shape[1] >= 2:
                    confidence_organik = 100 * prediction[0][0]
                    confidence_anorganik = 100 * prediction[0][1]
                    
                    # Enforce classification to anorganik if confidence in organik is below a stringent threshold
                    if confidence_organik < 50:  # Set a higher threshold for more certainty
                        confidence_organik = 0
                        confidence_anorganik = 100
                else:
                    # Jika prediksi tidak sesuai, tetapkan dominan ke class anorganik
                    confidence_organik = 0
                    confidence_anorganik = 60

                logging.info(f"Confidence Organik: {confidence_organik}%, Confidence Anorganik: {confidence_anorganik}%")
                return render_template("classifications.php", 
                                       img_path=os.path.join(app.config['UPLOAD_FOLDER'], filename), 
                                       prediction_organik=f'{confidence_organik:2.0f}%',
                                       prediction_anorganik=f'{confidence_anorganik:2.0f}%')
            except Exception as e:
                logging.error(f"Error during prediction: {e}")
                return jsonify({'message': 'Error during prediction'}), 500
        else:
            return jsonify({'message': f'File type of {file.filename} is not allowed'}), 400

def gen_frames():
    camera = cv2.VideoCapture(0)
    if not camera.isOpened():
        logging.error("Camera could not be opened")
        return
    
    while True:
        success, frame = camera.read()
        if not success:
            logging.error("Failed to capture image from camera")
            break
        else:
            ret, buffer = cv2.imencode('.jpg', frame)
            frame = buffer.tobytes()
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + frame + b'\r\n')
    camera.release()

@app.route('/video_feed')
def video_feed():
    return Response(gen_frames(), mimetype='multipart/x-mixed-replace; boundary=frame')

@app.route('/camera_predict', methods=['POST'])
def camera_predict():
    camera = cv2.VideoCapture(0)
    if not camera.isOpened():
        logging.error("Camera could not be opened")
        return jsonify({'message': 'Could not access the camera'}), 500

    ret, frame = camera.read()
    if not ret:
        logging.error("Failed to capture image from camera")
        return jsonify({'message': 'Could not capture image from camera'}), 500
    
    x = preprocess_camera_image(frame)
    if x is None:
        return jsonify({'message': 'Error processing the camera image'}), 400

    try:
        logging.debug("Making camera prediction")
        prediction = model.predict(x)
        logging.info(f"Prediction shape: {prediction.shape}")
        logging.info(f"Prediction values: {prediction}")

        class_names = ['organik', 'anorganik']
        confidence_organik, confidence_anorganik = "N/A", "N/A"
        
        if prediction.shape[1] >= 2:
            confidence_organik = 100 * prediction[0][0]
            confidence_anorganik = 100 * prediction[0][1]
            
            # Enforce classification to anorganik if confidence in organik is below a stringent threshold
            if confidence_organik < 50:  # Set a higher threshold for more certainty
                confidence_organik = 0
                confidence_anorganik = 100
        else:
            # Jika prediksi tidak sesuai, tetapkan dominan ke class anorganik
            confidence_organik = 0
            confidence_anorganik = 100

        logging.info(f"Confidence Organik: {confidence_organik}%, Confidence Anorganik: {confidence_anorganik}%")
        return jsonify({'confidence_organik': f'{confidence_organik:2.0f}%', 'confidence_anorganik': f'{confidence_anorganik:2.0f}%'})
    except Exception as e:
        logging.error(f"Error during prediction: {e}")
        return jsonify({'message': 'Error during prediction'}), 500

def save_image(image, folder):
    """Save the image to the specified folder and return the file path."""
    try:
        if not os.path.exists(folder):
            os.makedirs(folder)
        filename = f"{uuid.uuid4()}.jpg"
        file_path = os.path.join(folder, filename)
        image.save(file_path)
        logging.info(f"Image saved to {file_path}")
        return file_path
    except Exception as e:
        logging.error(f"Error saving image: {e}")
        return None

def predict_with_gradio(image):
    logging.debug("Received image for prediction")
    try:
        if isinstance(image, np.ndarray):
            logging.debug("Image is a numpy array")
            image = Image.fromarray(image)
        else:
            logging.debug("Image is not a numpy array")

        image = image.convert('RGB')
        image = image.resize((224, 224))  # Resize image to match model input
        x = img_to_array(image)
        logging.debug(f"Image shape before normalization: {x.shape}")
        x = x * 2.0 / 255.0  # Normalize image
        x = np.expand_dims(x, axis=0)
        logging.debug(f"Image shape after preprocessing: {x.shape}")

        logging.debug("Image preprocessed successfully")

        prediction = model.predict(x)
        logging.debug(f"Prediction shape: {prediction.shape}")
        logging.debug(f"Prediction values: {prediction}")

        class_names = ['organik', 'anorganik']
        confidence_organik, confidence_anorganik = "N/A", "N/A"
        result_class = "Unknown"
        
        if prediction.shape[1] >= 2:
            confidence_organik = 100 * prediction[0][0]
            confidence_anorganik = 100 * prediction[0][1]
            
            # Enforce classification to anorganik if confidence in organik is below a stringent threshold
            if confidence_organik < 50:  # Set a higher threshold for more certainty
                confidence_organik = 0
                confidence_anorganik = 100
                result_class = 'anorganik'
            else:
                result_class = 'organik'
        else:
            # Jika prediksi tidak sesuai, tetapkan dominan ke class anorganik
            confidence_organik = 0
            confidence_anorganik = 100
            result_class = 'anorganik'

        logging.debug(f"Confidence Organik: {confidence_organik}%, Confidence Anorganik: {confidence_anorganik}%")

        # Save original image to uploads folder
        save_image(image, UPLOAD_FOLDER)

        # Save prediction result to appropriate folder
        prediction_folder = os.path.join(PREDICTION_FOLDER, result_class)
        save_image(image, prediction_folder)

        return f'{confidence_organik:2.0f}%', f'{confidence_anorganik:2.0f}%'
    except Exception as e:
        logging.error(f"Error during Gradio prediction: {e}")
        return "Error", "Error"

# Modify the Gradio interface to include image saving and prediction saving
gradio_interface = gr.Interface(
    fn=predict_with_gradio,
    inputs=gr.Image(),
    outputs=[gr.Text(label="Prediksi Organik"), gr.Text(label="Prediksi Anorganik")],
    live=True
)

@app.route("/gradio")
def gradio_ui():
    return redirect("http://127.0.0.1:7861")

def start_gradio():
    try:
        gradio_interface.launch(server_name="0.0.0.0", server_port=7861, share=False)
    except Exception as e:
        logging.error(f"Error launching Gradio: {e}")

if __name__ == '__main__':
    threading.Thread(target=start_gradio).start()
    app.run(debug=True)

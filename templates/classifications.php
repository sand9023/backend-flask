<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Klasifikasi Gambar - Sistem Klasifikasi Sampah</title>
    <meta name="description" content="Klasifikasi Gambar - Sistem Klasifikasi Sampah">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/css/normalize.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/scss/style.css">
    <link rel="stylesheet" href="/static/pestectionadmin/assets/scss/widgets.css">
    <link href="/static/pestectionadmin/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/">Sistem Klasifikasi Sampah</a>
                <a class="navbar-brand hidden" href="/">SK</a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/"> <i class="menu-icon fa fa-home"></i>Home </a>
                    </li>
                    <li>
                        <a href="/education"> <i class="menu-icon fa fa-book"></i>Edukasi </a>
                    </li>
                    <li>
                        <a href="/classifications"> <i class="menu-icon fa fa-image"></i>Klasifikasi Gambar </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left"></div>
                </div>
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="/static/pestectionadmin/images/admin.jpg" alt="User Avatar">
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="content mt-3">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukkan Gambar</h4>
                    </div>
                    <div class="card-body">
                        <form action="/submit" method="post" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Unggah Berkas</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file" name="file" class="form-control-file"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" style="margin-left: 15px;"></div>
                                <button type="submit" class="btn btn-primary" value="Upload">Unggah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Ambil Gambar dengan Kamera</h4>
                    </div>
                    <div class="card-body text-center">
                        <a href="http://127.0.0.1:7861" target="_blank" class="btn btn-primary">Buka Kamera</a>
                    </div>
                </div>
            </div>

<!--
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Deteksi Kamera Langsung</h4>
        </div>
        <div class="card-body text-center">
            <a href="/opencv_feed" target="_blank" class="btn btn-primary">Deteksi Kamera</a>
        </div>
    </div>
</div>
-->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Hasil Klasifikasi</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ img_path }}" alt="Gambar Prediksi" class="img-fluid"><br>
                        <h4>Prediksi Organik: <i>{{ prediction_organik }}</i></h4>
                        <h4>Prediksi Anorganik: <i>{{ prediction_anorganik }}</i></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/static/pestectionadmin/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="/static/pestectionadmin/assets/js/plugins.js"></script>
    <script src="/static/pestectionadmin/assets/js/main.js"></script>
    <script src="/static/pestectionadmin/assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="/static/pestectionadmin/assets/js/dashboard.js"></script>
    <script src="/static/pestectionadmin/assets/js/widgets.js"></script>
    <script src="/static/pestectionadmin/assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="/static/pestectionadmin/assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="/static/pestectionadmin/assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="/static/pestectionadmin/assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        (function ($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>
</body>
</html>

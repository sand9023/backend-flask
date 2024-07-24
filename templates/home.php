<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home - Sistem Klasifikasi Sampah</title>
    <meta name="description" content="Home - Sistem Klasifikasi Sampah">
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
    <style>
        .content-box {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .content-box h4 {
            margin-top: 0;
        }
        .hero {
            background: url('/mnt/data/image.png') no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            margin: 0;
            font-size: 48px;
            font-weight: 700;
            color: #000000; /* Hitam */
        }
        .hero h2 {
            margin: 0;
            font-size: 36px;
            font-weight: 700;
            color: #FFA500; /* Orange */
        }
        .hero h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #007bff; /* Biru */
        }
        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .hero a {
            color: #fff;
            background-color: #1de9b6;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
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
                        <a href="/classifications"> <i class="menu-icon fa fa-image"></i>Klasifikasi Sampah </a>
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
        <div class="hero">
            <div class="container">
                <h1>Selamat Datang di Sistem Klasifikasi Sampah</h1>
                <h2>Memudahkan proses pemilahan sampah dengan teknologi terkini,</h2>
                <h3>Pilih menu yang Anda inginkan dibawah ini</h3>
            </div>
        </div>
        <div class="content mt-3">
            <div class="container">
                <div id="features" class="row">
                    <div class="col-lg-6">
                        <div class="content-box">
                            <h4>Edukasi</h4>
                            <p>Pelajari tentang pengelolaan sampah dan pentingnya pemilahan sampah.</p>
                            <a href="/education" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content-box">
                            <h4>Klasifikasi Sampah</h4>
                            <p>Unggah gambar sampah dan dapatkan hasil klasifikasi secara instan.</p>
                            <a href="/classifications" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-box">
                            <h4>Tentang Kami</h4>
                            <p>Sistem Klasifikasi Sampah adalah inisiatif untuk membantu masyarakat dalam memilah dan mengelola sampah dengan lebih baik menggunakan teknologi AI. Kami percaya bahwa dengan pemilahan sampah yang tepat, kita dapat menjaga kebersihan lingkungan dan mendukung keberlanjutan.</p>
                        </div>
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

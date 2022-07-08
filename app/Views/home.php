<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" href="<?= base_url(); ?>/assets/images/logo.png" type="image/gif">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background-color: #000000;
        }

        li {
            font-size: 20px;
        }
    </style>
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 text-white mt-5">
                <h1 class="mt-5">
                    <strong>
                        Simpan Berkas Berharga Anda Dengan
                        <span class="text-primary">E-Arsip</span>
                    </strong>
                </h1>
                <p class="mt-5">
                    E-Arsip adalah aplikasi untuk menyimpan dan membagikan berkas/dokumen.
                </p>
                <button type="button" class="btn btn-primary btn-lg mt-4">
                    <a class="text-white text-decoration-none" href="<?= route_to('login'); ?>">
                        <?php if (session()->get('isLoggedIn')) : ?>
                            Kembali Ke Halaman Dashboard
                        <?php else : ?>
                            Login Sekarang!
                        <?php endif; ?>
                    </a>
                </button>
            </div>
            <div class="col-md-6 mt-5 ml-5">
                <img src="<?= base_url() ?>/assets/images/bg.png" class="mt-5 ml-5" width="500px" height="auto">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<!-- Use Ajax Jquery -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<?php

if (isset($_GET['tiket'])) {

    // Show Download Information Modal
    echo "
    <script type=\"text/javascript\">
        $(document).ready(function(){
            $(\"#download-information-modal\").modal('show');
        });
    </script>
    ";

    $path = getenv("HOMEDRIVE") . getenv("HOMEPATH") . "\Downloads";
    $nomortiket = "000" . rand(0, 1000);

    $text = "====================== TIKET ======================\n";
    $text .= "Nomor Tiket   :  " . $nomortiket . "\n";
    $text .= "Nama          : " . $_GET['nama'] . "\n";
    $text .= "Alamat        : " . $_GET['alamat'] . "\n";
    $text .= "Email         : " . $_GET['email'] . "\n";
    $text .= "No Handphone  : " . $_GET['nomorhandphone'] . "\n";
    $text .= "====================== TIKET ======================\n";

    $fp = fopen($path . "/bukti-tiket-" . $nomortiket . ".txt", "w");
    fwrite($fp, $text);
    fclose($fp);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/ticket.css">
    <title>Article</title>
</head>

<body>
    <!-- Nav Bar -->
    <header>
        <div class="nav_bar">
            <a href="../index.php" class="logo">nature</a>
            <div class="navigation">
                <div class="nav_items">
                    <i class="uil uil-times nav_close_btn"></i>
                    <a href="../index.php"><i class="uil uil-home"></i>Home</a>
                    <a href="../pages/article.php"><i class="uil uil-compass"></i>Article</a>
                    <a href="../pages/ticket.php"><i class="uil uil-info-circle"></i>Ticket</a>
                    <a href="../index.php#contact"><i class="uil uil-envelope"></i>Contact</a>
                </div>
            </div>
            <i class="uil uil-apps nav_menu_btn"></i>
        </div>
    </header>

    <!-- Ticket Form -->
    <div class="card">
        <div class="card-header text-center">
            Daftar Tiket
        </div>
        <div class="card-body">
            <form action="#" method="get">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="nama" placeholder="Nama">
                    <label for="name" class="form-label">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    <label for="alamat" class="form-label">Alamat</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    <label for="email" class="form-label">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nomorhandphone" name="nomorhandphone" placeholder="No Handphone">
                    <label for="nomorhandphone" class="form-label">No Handphone</label>
                </div>
                <button type="submit" class="btn btn-primary" name="tiket">Submit</button>
            </form>
        </div>
        <div class="card-footer text-body-secondary text-center">
            2023 © Pemweb Kel.10
        </div>
    </div>

    <!-- Modal Informasi Tiket Sudah Ter-download -->
    <div class="modal fade" id="download-information-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Download Success</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your ticket has been downloaded, check your download folder to check your ticket</p>
                    <p>Make sure to keep save the ticket and dont lost it!</p>
                    <p>Bring the ticket when you want to go to Mt. Kelud</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
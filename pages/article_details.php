<?php
include_once("../helper/config.php");

// CALL REST API
if (isset($_GET['id'])) {
    $curl = curl_init();
    $id = $_GET['id'];
    $url = ($_SERVER['HTTP_HOST'] . "/pemweb-kel10/api/Article/id/" . $id);

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ),
    );

    $response = curl_exec($curl);

    $response = json_decode($response, true);

    $a = $response['data'];
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
    <link rel="stylesheet" href="../styles/article.css">
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

    <!-- Article -->
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="col-md-12">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src=<?= $a['image_address'] ?> alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $a['title'] ?></h5>
                        <p class="card-text"><?= $a['body'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?= $a['category'] ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
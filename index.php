<?php
session_start();
include_once('./helper/config.php');

// FIXME: WRAP CEK COOKIE DAN CEK SESSION KE DALAM LOGIN BUTTON EVENT LISTENER
// Cek Cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
    $result = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $result['email'])) {
        $_SESSION['login'] = true;
    }
}
// Cek Session
if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] === true) {
        header("Location: ./pages/admin.php");
    }
}

// Login Listener
if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user if exist
    $result = mysqli_query($conn, "SELECT * FROM user where email='$email'");

    // Verify password (weakness without hash)
    if (mysqli_num_rows($result) === 1) {

        $result = mysqli_fetch_array($result);
        if ($result['password'] === $password) {

            // Set cookie
            if (isset($_POST['rememberme'])) {
                setcookie('id', $result['id'], time() + 300);
                setcookie('key', hash('sha256', $email), time() + 300);
            }

            $_SESSION['login'] = true;
            header("Location: ./pages/admin.php");
        } else {
            // Wrong password
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="./styles/style.css">

    <title>Pemweb Kelompok 10</title>
</head>

<body>
    <!-- Nav Bar -->
    <header>
        <div class="nav_bar">
            <a href="" class="logo">Gunung Kelud</a>
            <div class="navigation">
                <div class="nav_items">
                    <i class="uil uil-times nav_close_btn"></i>
                    <a href="./"><i class="uil uil-home"></i>Home</a>
                    <a href="./pages/article.php"><i class="uil uil-compass"></i>Article</a>
                    <a href="./pages/ticket.php"><i class="uil uil-info-circle"></i>Ticket</a>
                    <a href="#contact"><i class="uil uil-envelope"></i>Contact</a>
                    <a href="" id="login-button" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="uil uil-user"></i>Login</a>
                </div>
            </div>
            <i class="uil uil-apps nav_menu_btn"></i>
        </div>
    </header>

    <!-- Hero -->
    <section class="home">
        <div class="media_icons">
            <a href="https://www.facebook.com/GunungKeludLagi/" target="_blank"><i class="uil uil-facebook-f"></i></a>
            <a href="https://www.instagram.com/wisatakelud/" target="_blank"><i class="uil uil-instagram"></i></a>
            <a href="https://wa.me/6281234567890" target="_blank"><i class="uil uil-whatsapp"></i></a>
        </div>
        <div class="swiper bg_slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="./assets/8.jpg" alt="">
                    <div class="text_content">
                        <h2 class="title">Plant <span>Season</span></h2>
                        <p>
                            Gunung Kelud adalah salah satu gunung berapi paling aktif di Indonedia. Kelud merupakan Si Pembara yang anggun terletak diantara Kabupaten Kediri dan Kabupaten Blitar. Mulai tahun 1000 M hingga sekarang, Kelud pernah meletus sampai 30 kali, dengan letusan terbesar kekuatan 5  Volcanic Explosivity Index (VEI).

Kemegahan dan keindahan alam yang luar biasa menaklukkan hati para pengagumnya. Puncaknya yang menjulang tinggi menyongsong langit, seakan menantang para petualang untuk menguak misterinya. Kelud menawarkan keajaiban alam yang tak terduga. Ketika terbit fajar di atas cakrawala, pesona kawahnya yang luas dan indah akan membuat hati Anda terpukau. Kawah berwarna hijau kebiruan, dikelilingi oleh dinding batuan yang megah, menciptakan gambaran yang menakjubkan. Kelud juga dikelilingi oleh hamparan perkebunan dan lereng yang subur. Hutan hijau yang rimbun dan padang rumput yang terhampar memancarkan kehidupan yang tak tergoyahkan.
                        </p>
                        <button class="read_btn">Read More <i class="uil uil-arrow-right"></i></button>
                    </div>
                </div>
                <div class="swiper-slide dark_layer">
                    <img src="./assets/7.jpg" alt="">
                    <div class="text_content">
                        <h2 class="title">Sunrise <span>Forest</span></h2>
                        <p>
                        Gemerlapnya sinar matahari yang terbit di atas Gunung Kelud 
                        memancarkan kehangatan dan keajaiban alam yang mempesona.
                        Seolah-olah alam ini memberikan sambutan hangat dan penuh harapan, 
                        membangunkan jiwa petualang dalam diri kita untuk menjelajahi 
                        keindahan alam yang belum terjamah di lereng gunung yang kokoh ini.
                        </p>
                        <button class="read_btn">Read More <i class="uil uil-arrow-right"></i></button>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="./assets/16.jpg" alt="">
                    <div class="text_content">
                        <h2 class="title">Lightning <span>Purple</span></h2>
                        <p>
                        Dalam kesejukan dan keheningan Gunung Kelud, terhamparlah sebuah keajaiban alam 
yang tiada taranya - hamparan hutan yang menawan. Pepohonan menjulang gagah 
dengan dedaunan yang berkilauan, menciptakan atap hijau yang melindungi dan 
menari dengan gemerlap sinar matahari yang tembus melalui celah-celahnya.
                        </p>
                        <button class="read_btn">Read More <i class="uil uil-arrow-right"></i></button>
                    </div>
                </div>
                <div class="swiper-slide dark_layer">
                    <img src="./assets/17.jpg" alt="">
                    <div class="text_content">
                        <h2 class="title">Ocean <span>Sunset</span></h2>
                        <p>
                        Saat matahari merangkak perlahan menuju cakrawala di Gunung Kelud, 
                        pemandangan yang menakjubkan pun terbentang di depan mata. 
                        Cahaya jingga yang membara dan langit yang berpadu dengan gradasi 
                        warna-warni memberikan tontonan yang menawan dan memikat hati.
                        </p>
                        <button class="read_btn">Read More <i class="uil uil-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg_slider_thumbs">
            <div class="swiper-wrapper thumbs_container">
                <img src="./assets/8.jpg" class="swiper-slide">
                <img src="./assets/7.jpg" class="swiper-slide">
                <img src="./assets/16.jpg" class="swiper-slide">
                <img src="./assets/17.jpg" class="swiper-slide">
            </div>
        </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="about" id="explore">
        <div class="details">
            <h2>Explore</h2>
            <p>
                Kemegahan dan keindahan alam yang luar biasa menaklukkan hati para pengagumnya. 
                Puncaknya yang menjulang tinggi menyongsong langit, 
                seakan menantang para petualang untuk menguak misterinya. 
                Kelud menawarkan keajaiban alam yang tak terduga. Ketika terbit fajar di atas cakrawala, 
                pesona kawahnya yang luas dan indah akan membuat hati Anda terpukau. 
                Kawah berwarna hijau kebiruan, dikelilingi oleh dinding batuan yang megah, 
                menciptakan gambaran yang menakjubkan. Kelud juga dikelilingi oleh hamparan perkebunan dan lereng yang subur. 
                Hutan hijau yang rimbun dan padang rumput yang terhampar memancarkan kehidupan yang tak tergoyahkan.
            </p>
        </div>
        <div class="image_gallery">
            <div class="image_card">
                <img src="./assets/8.jpg" data-aos="fade-up" data-aos-delay="100">
            </div>
            <div class="image_card">
                <img src="./assets/9.jpg" data-aos="fade-up" data-aos-delay="400">
            </div>
            <div class="image_card">
                <img src="./assets/10.jpg" data-aos="fade-up" data-aos-delay="700">
            </div>
            <div class="image_card">
                <img src="./assets/17.jpg" data-aos="fade-up" data-aos-delay="1000">
            </div>
        </div>
    </section>

    <!-- Login Modal Form -->
    <div class="modal fade" tabindex="-1" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./index.php" method="POST">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Email">
                            <label for="email" class="form-label">Email address</label>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
                            <label class="form-check-label" for="rememberme">Remember Me</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="Login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container" id="contact">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary">
                &copy; 2023 - Pemweb Kel.10
                <br>21081010014 Izzudin Adian Khusaini
                <br>20081010247 Sarah Fawazy Abdilah
                <br>21081010294 Lativa Yulia Taviani
                <br>21081010151 Dimas Saputra
            </p>

            <a href="./" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <i class="uil uil-mountains"></i>
                
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="./"><i class="uil uil-home"></i>Home</a></li>
                <li class="nav-item"><a href="./pages/article.php"><i class="uil uil-compass"></i>Article</a></li>
                <li class="nav-item"><a href="./pages/ticket.php"><i class="uil uil-info-circle"></i>Ticket</a></li>
            </ul>
        </footer>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="./javascript/index.js"></script>

</body>

</html>
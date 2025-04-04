<!-- Use Ajax Jquery -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<?php
session_start();
include_once('../helper/config.php');

// Cek Session & Cookie
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

// Create Article
if (isset($_POST['AddArticle'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $body = $_POST['body'];

    // Insert article data
    mysqli_query($conn, "INSERT INTO article(title,category,image_address,body) VALUES('$title','$category','$image','$body')");
}

// Read Article
$articles = mysqli_query($conn, "SELECT * FROMA article ORDER BY id ASC");

// Update Article
if (isset($_GET['id_edit'])) {

    // Show Modal
    echo "
    <script type=\"text/javascript\">
        $(document).ready(function(){
            $(\"#article-edit-modal\").modal('show');
        });
    </script>
    ";

    // Get Article Data
    $id = $_GET['id_edit'];
    $article_edit = mysqli_query($conn, "SELECT * FROM article WHERE id=$id");
    $article_edit = mysqli_fetch_array($article_edit);
}
if (isset($_POST['EditArticle'])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $category = $_POST["category"];
    $image = $_POST["image"];
    $body = $_POST["body"];
    var_dump($_POST);

    mysqli_query($conn, "UPDATE article SET title='$title', category='$category', image_address='$image', body='$body' WHERE id=$id");
    header("Refresh:0; url=admin.php");
}

// Delete Article
if (isset($_GET['id_delete'])) {
    // Delete Article Data
    $id = $_GET['id_delete'];
    mysqli_query($conn, "DELETE FROM article WHERE id=$id");
    header("Refresh:0; url=admin.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <title>Pemweb Kelompok 10</title>
</head>

<body>
    <!-- Top Nav Bar -->
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
                    <a href="../helper/logout.php"><i class="uil uil-user"></i>Logout</a>
                </div>
            </div>
            <i class="uil uil-apps nav_menu_btn"></i>
        </div>
    </header>

    <!-- Insert Article -->
    <div class="article">
        <h2>Article</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#article-modal">Add Article</button>
    </div>

    <br>
    <!-- Article Table -->
    <div class="table">
        <table class="table table-hover table-primary table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Body</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($article = mysqli_fetch_array($articles)) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $i . "</th>";
                    echo "<td>" . $article['title'] . "</td>";
                    echo "<td>" . $article['category'] . "</td>";
                    echo "
                    <td> 
                        <img src=" . $article['image_address'] . " class=\"rounded-2\" width=\"200\" height=\"300\" alt=\"article-image\">
                    </td>";
                    echo "<td>" . $article['body'] . "</td>";
                    echo "<td>";
                    echo "<a href=\"?id_edit=" . $article['id'] . "\" class=\"btn btn-info\">Edit</a>";
                    echo "&ensp;";
                    echo "<a href=\"?id_delete=" . $article['id'] . "\" class=\"btn btn-danger\">Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Article Modal -->
    <div class="modal fade" id="article-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New Article</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" aria-describedby="categoryHelp" name="category">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image Address</label>
                            <input type="text" class="form-control" id="image" aria-describedby="imageHelp" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="body">Body</label>
                            <textarea class="form-control" placeholder="Article Body" id="body" style="height: 100px" name="body"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="AddArticle" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Article Modal -->
    <div class="modal fade" id="article-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Article</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" value=<?php echo $article_edit['id']; ?>>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title" value=<?= $article_edit['title'] ?>>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" aria-describedby="categoryHelp" name="category" value=<?= $article_edit['category'] ?>>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image Address</label>
                            <input type="text" class="form-control" id="image" aria-describedby="imageHelp" name="image" value=<?= $article_edit['image_address'] ?>>
                        </div>
                        <div class="mb-3">
                            <label for="body">Body</label>
                            <textarea class="form-control" placeholder="Article Body" id="body" style="height: 100px" name="body"><?= $article_edit['body'] ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="EditArticle" class="btn btn-primary" data-bs-dismiss="modal">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>
<?php
  if (isset($_POST["submit"])) {
    $file_name = $_FILES['image_file']['name'];
    $file_tmp_name = $_FILES['image_file']['tmp_name'];
    $upload_path = getcwd() . "/images/products" . basename($file_name);
    $is_uploaded = move_uploaded_file($file_tmp_name, $upload_path);
    if ($is_uploaded) {
      echo "1";
    } else{
      echo "0";
    }

    // TODO: create product.
    error_log("xiyar: " . $_POST["product_title"]);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/515b3cf6cd.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>

    <meta charset="utf-8">
    <meta name="description" content="A cup full of love">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>gultea - a cup full of love ☕ ❤️</title>
</head>

<body>
    <header>
        <nav>
            <a href="index.html">
                <img alt="Logo" src="images/logo-icon.png" height="70">
                <img src="images/logo-text.png" height="50">
            </a>
            <ul>
                <li>
                    <form action="search.html" method="GET">
                        <input type="text" placeholder="search..." id="txt-search" name="search" />
                        <button type="submit" id="btn-search">Search</button>
                    </form>
                </li>
                <li><a href="#">Categories</a>
                    <ul>
                        <li><a href="#">Energizing</a></li>
                        <li><a href="#">Stress relief</a></li>
                        <li><a href="#">Breakfast blend</a></li>
                        <li><a href="#">Pregnancy</a></li>
                    </ul>
                </li>
                <li><a href="#">About</a></li>
                <li>|</li>
                <li class="icon"><a href="#" title="Sign Up"><i class="fa fa-user"></i></a></li>
                <li class="icon"><a href="#" title="View Cart"><i class="fas fa-cart-arrow-down">(0)</i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        </div>
        <section>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Product title" name="product_title" />
                <input type="file" accept="image/*" name="image_file">
                <button type="submit" id="btn-search" name="submit">Create</button>
            </form>
        </section>
    </main>
    <footer>
        <hr>
        <nav>
            <ul>
                <li>© 2021</li>
                <li>|</li>
                <li><a href="index.html">Home</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </footer>
</body>

</html>
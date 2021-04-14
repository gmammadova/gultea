<?php
    require_once('./dao/product_dao.php');

    if (isset($_POST["submit"])) {
        $product_dao = new ProductDAO();

        // Create the product
        $is_featured = 0;
        if ($_POST["product_is_featured"] == 'on') {
            $is_featured = 1;
        }
        $product_id = $product_dao->create_product(
            $_POST["product_title"],
            $_POST["product_description"],
            $_POST["product_price"],
            $is_featured
        );

        // Store product image and register it in the database
        // and associate with the product.
        $product_image_file = $_FILES['product_image_file'];
        $file_name = $product_image_file['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_tmp_name = $product_image_file['tmp_name'];
        $image_id = $product_dao->create_image($product_id, $file_name, $file_extension);
        $upload_path = getcwd() . "/images/products/" . $image_id . '.' . $file_extension;
        $is_uploaded = move_uploaded_file($file_tmp_name, $upload_path);

        if (isset($product_id) && isset($is_uploaded)) {
            header('Location: upload.php?success=1');
        } else {
            header('Location: upload.php?success=0');
        }
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
                    <form action="search.php" method="GET">
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
        <div style="text-align: center;">
            <?php
                if (isset($_GET['success'])) {
                    if ($_GET['success'] == '1') {
                        echo '<p>Successfully created.</p>';
                    } else {
                        echo '<p>Error creating the product.</p>';
                    }
                }
            ?>
        </div>
        <section>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <label for="product_title">Product title</label>
                <input type="text" placeholder="Product title" name="product_title" style="width: 415px" />

                <label for="product_description">Product description</label>
                <textarea name="product_description" rows="8" cols="50"></textarea>

                <label for="product_price">Product price</label>
                <input type="number" name="product_price" step="0.01" />

                <div>
                    <input type="checkbox" name="product_is_featured"/>
                    <label for="product_is_featured">Product is featured</label>
                </div>

                <div>
                    <label for="product_image_file">Product image</label>
                    <input type="file" accept="image/*" name="product_image_file">
                </div>

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
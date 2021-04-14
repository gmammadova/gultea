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

<?php include 'includes/header.php' ?>

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

<?php include 'includes/footer.php' ?>
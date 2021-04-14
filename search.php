<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/515b3cf6cd.js" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
        setAllProducts(<?php
            require_once('./dao/product_dao.php');
            $product_dao = new ProductDAO();
            echo json_encode($product_dao->get_all(), JSON_HEX_TAG);
        ?>);
    </script>

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
        <section>
            <header>
                <h2>Search results</h2>
                <form onsubmit="return filterProducts()" class="search-filtering">
                    <label for="min-price">Min price</label>
                    <input type="number" id="min-price" value="0">
                    <label for="max-price">Max price</label>
                    <input type="number" id="max-price" value="50">
                    <label for="order-by-price">Sort by price</label>
                    <select id=order-by-price>
                        <option>Low to high</option>
                        <option>High to low</option>
                    </select>
                    <button type="submit">Apply</button>
                </form>
            </header>
            <section id="products">
                <script type="text/javascript">showSearchResults()</script>
            </section>
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
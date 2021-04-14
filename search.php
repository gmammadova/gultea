<?php include 'includes/header.php' ?>
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
<?php include 'includes/header.php' ?>
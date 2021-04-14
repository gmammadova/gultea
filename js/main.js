class Product {
    constructor(id, title, description, price, reviews, images, isFeatured) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.price = price;
        this.reviews = reviews;
        this.images = images;
        this.isFeatured = isFeatured;
    }

    averageReview() {
        var total = 0;

        for(let review of this.reviews) {
            total += review;
        }

        return total / this.reviews.length;
    }

    averageRatingAsHTML() {
        var html = '<p><small>';
        
        const flooredReview = Math.floor(this.averageReview());
        const delta = this.averageReview() - flooredReview;
        var numberOfFullStars = 0;
        var numberOfHalfStars = 0;
        var numberOfEmptyStars = 5;

        if (delta < 0.3) {
            numberOfFullStars = flooredReview;
            numberOfHalfStars = 0;
            numberOfEmptyStars = 5 - flooredReview;
        } else if (delta < 0.7) {
            numberOfFullStars = flooredReview;
            numberOfHalfStars = 1;
            numberOfEmptyStars = 5 - (flooredReview + 1);
        } else {
            numberOfFullStars = flooredReview;
            numberOfHalfStars = 0;
            numberOfEmptyStars = 5 - flooredReview;
        }
        numberOfEmptyStars = 5 - (numberOfFullStars + numberOfHalfStars);

        for (let i = 0; i < numberOfFullStars; i++) {
            html += '<i class="fas fa-star"></i>';
        }
        for (let i = 0; i < numberOfHalfStars; i++) {
            html += '<i class="fas fa-star-half-alt"></i>';
        }
        for (let i = 0; i < numberOfEmptyStars; i++) {
            html += '<i class="far fa-star"></i>';
        }

        html += this.reviews.length + ' Reviews';
        html += '</small></p>';
        return html;
    }

    toHTML() {
        var html = '<aside class="product">';
        html += '<a href="product.php?id=' + this.id + '">';
        html += '<img src="' + this.images[0] + '" />';
        html += '<div>'
        html += '<p>' + this.title + '</p>';
        html += '<p><small>Price: $' + this.price.toFixed(2) + '</small></p>';
        html += this.averageRatingAsHTML();
        html += '</div></a></aside>';

        return html;
    }
}

// This is fed by PHP using through setAllProducts function.
var allProducts = []

function showProducts(products) {
    var productsStr = ''
    for (let product of products) {
        productsStr += product.toHTML();
    }
    document.getElementById("products").innerHTML = productsStr;
}

function listFeaturedProducts() {
    showProducts(allProducts.filter(product => product.isFeatured));
}

function getSearchResults(orderByPriceDirection) {
    const query = window.location.search.split("=")[1].toLowerCase();
    document.getElementById("txt-search").value = query;

    return allProducts.filter(product => product.title.toLowerCase().includes(query) || product.description.toLowerCase().includes(query) || query.length === 0)
        .sort((a, b) => orderByPriceDirection * (a.price - b.price));
}

function showSearchResults() {
    showProducts(getSearchResults(1));
}

function filterProducts() {
    const minPrice = parseInt(document.getElementById("min-price").value);
    const maxPrice = parseInt(document.getElementById("max-price").value);
    const orderByPrice = document.getElementById("order-by-price").value;
    
    var orderByPriceDirection = 1;
    if (orderByPrice === "High to low") {
        orderByPriceDirection = -1;
    }

    const filteredProducts = getSearchResults(orderByPriceDirection);

    showProducts(filteredProducts.filter(product => product.price >= minPrice && product.price <= maxPrice));

    return false;
}

function showProductDetails() {
    const id = parseInt(window.location.search.split("=")[1]);
    const product = allProducts.find(product => product.id === id);
    
    var html = '<div class="left-col">';
    for (let image of product.images) {
        html += '<figure><img alt="Stock photo" src="' + image + '"></figure>';
    }
    html += '</div>';
    html += '<div class="right-col">'
    html += '<h2>' + product.title + ' - $<span id="product-price">' + product.price.toFixed(2) +'</span></h2>'
    html += product.averageRatingAsHTML();
    html += '<p>' + product.description + '</p>';
    html += '<form onsubmit="return updatePrice()" method="POST" id="add-to-cart"><div>';
    html += '<label for="quantity">Quantity</label>';
    html += '<input type="number" value="1" id="quantity"></div>';
    html += '<button type="submit">Add to Cart</button>';
    html += '</form></div><div class="clearfix"></div>';

    document.getElementById("product-details").innerHTML = html;
}

function updatePrice() {
    const quantity = parseInt(document.getElementById("quantity").value);
    const id = parseInt(window.location.search.split("=")[1]);
    const product = allProducts.find(product => product.id === id);

    document.getElementById("product-price").innerText = (product.price * quantity).toFixed(2);

    return false;
}

function setAllProducts(products) {
    newAllProducts = []

    for (let product of products) {
        newAllProducts.push(new Product(
            product.id,
            product.title,
            product.description,
            product.price,
            product.reviews,
            product.images,
            product.is_featured));
    }

    allProducts = newAllProducts;
}
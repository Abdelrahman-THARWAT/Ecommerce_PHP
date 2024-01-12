<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Filter</h2>

    <form id="filterForm">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="category">Category:</label>
                <select class="form-control" id="category">
                    <option value="">All Categories</option>
                    <option value="clothing">Clothing</option>
                    <option value="electronics">Electronics</option>
                    <option value="furniture">Furniture</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="priceRange">Price Range:</label>
                <select class="form-control" id="priceRange">
                    <option value="">All Prices</option>
                    <option value="0-50">$0 - $50</option>
                    <option value="50-100">$50 - $100</option>
                    <option value="100-200">$100 - $200</option>
                    <option value="200+">$200 and above</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <button type="button" class="btn btn-primary btn-block" onclick="filterProducts()">Apply Filter</button>
            </div>
        </div>
    </form>

    <div class="row" id="productList">
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // Sample product data (replace with your actual data ' our data in DataBase')
    const products = [
        { name: 'Product 1', category: 'clothing', price: 30 },
        { name: 'Product 2', category: 'electronics', price: 80 },
        { name: 'Product 3', category: 'furniture', price: 150 },
        // Add more products as needed
    ];

    // Function to filter products based on selected options
    function filterProducts() {
        const category = $('#category').val();
        const priceRange = $('#priceRange').val();

        const filteredProducts = products.filter(product => {
            
            if (category && product.category !== category) {
                return false;
            }
            if (priceRange) {
                const [minPrice, maxPrice] = priceRange.split('-');
                const productPrice = parseInt(product.price);
                if (minPrice && productPrice < parseInt(minPrice)) {
                    return false;
                }
                if (maxPrice && productPrice > parseInt(maxPrice)) {
                    return false;
                }
            }
            return true;
        });

        displayProducts(filteredProducts);
    }

    // Function to display filtered products!
    function displayProducts(filteredProducts) {
        const productList = $('#productList');
        productList.empty();

        filteredProducts.forEach(product => {
            const card = `
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="../img/Granite square side table 1.png" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">Category: ${product.category}</p>
                            <p class="card-text">Price: $${product.price.toFixed(2)}</p>
                        </div>
                    </div>
                </div>
            `;
            productList.append(card);
        });
    }

    // Initial display of all products
    displayProducts(products);
</script>
</body>
</html>

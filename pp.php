
<?php
session_start();

// PDO Connection
$host = 'localhost';
$dbname = 'web';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $Price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Insert into cart table
    $stmt = $pdo->prepare("INSERT INTO cart (name, price, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$name, $Price, $quantity]);

    header("Location: pp.php"); // Redirect to cart page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Croissant - Bakery Delights</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f9f5f0;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .product-page {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 30px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .product-images {
            flex: 1;
            min-width: 300px;
        }
        
        .main-image {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .thumbnail-container {
            display: flex;
            gap: 10px;
        }
        
        .thumbnail {
            width: 70px;
            height: 70px;
            border-radius: 5px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .thumbnail:hover {
            border-color: #d4a762;
        }
        
        .product-details {
            flex: 1;
            min-width: 300px;
        }
        
        .product-title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: #4a0638;
        }
        
        .rating {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .rating i {
            color: #ffc107;
            margin-right: 3px;
        }
        
        .rating span {
            margin-left: 10px;
            font-weight: 600;
            color: #555;
        }
        
        .price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #4a0638;
            margin: 20px 0;
        }
        
        .description {
            margin-bottom: 25px;
            color: #555;
            line-height: 1.7;
        }
        
        .details-list {
            margin-bottom: 25px;
        }
        
        .details-list li {
            margin-bottom: 8px;
            list-style-type: none;
            position: relative;
            padding-left: 25px;
        }
        
        .details-list li:before {
            content: "•";
            color: #4a0638;
            font-size: 1.5rem;
            position: absolute;
            left: 0;
            top: -3px;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .quantity-btn {
            width: 35px;
            height: 35px;
            background: #f0e6d6;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
        }
        
        .quantity-input {
            width: 50px;
            height: 35px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .add-to-cart {
            background-color: #d4a762;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }
        
        .add-to-cart:hover {
            background-color: #4a0638;
        }
        
        .wishlist {
            display: flex;
            align-items: center;
            color: #555;
            cursor: pointer;
            margin-bottom: 30px;
        }
        
        .wishlist i {
            margin-right: 8px;
            color: #4a0638;
        }
        
        .product-meta {
            border-top: 1px solid #eee;
            padding-top: 20px;
            color: #777;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .product-page {
                flex-direction: column;
            }
            
            .product-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

</a>
    <div class="container">
        <div class="product-page">
            <div class="product-images">
                <img src="choccr.jpg" alt="Chocolate Croissant" class="main-image">
            
            </div>
            
            <div class="product-details">
                <h1 class="product-title">Chocolate Croissant</h1>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>4.5 (128 reviews)</span>
                </div>
                
                <div class="price">50 EGP</div>
                
                <p class="description">
                    Our signature Chocolate Croissant is a perfect blend of flaky, buttery layers with a rich dark chocolate filling. 
                    Made with premium French butter and high-quality Belgian chocolate, each bite delivers a perfect balance of 
                    crispiness and melt-in-your-mouth goodness.
                </p>
                
                <ul class="details-list">
                    <li>Made fresh daily with organic ingredients</li>
                    <li>Contains 3 layers of premium dark chocolate</li>
                    <li>Perfectly crisp exterior with soft, airy interior</li>
                    <li>Ideal with coffee or as a sweet treat anytime</li>
                    <li>Vegetarian friendly</li>
                </ul>
                <form action="" method="POST">    
    <input type="hidden" name="name" value="Chocolate Croissant">
    <input type="hidden" name="price" value="50">
    <button class="quantity-btn">-</button>
    <input type="number" name="quantity" value="1" min="1" class="quantity-input">
    <button class="quantity-btn">+</button>
    <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
</form>
                
                
                <div class="wishlist">
                    <i class="far fa-heart"></i>
                    <span>Add to wishlist</span>
                </div>
                
                <div class="product-meta">
                    <p><strong>Category:</strong> croissants, Breakfast</p>
                    <p><strong>Tags:</strong> Chocolate, Croissant, French, Breakfast, Sweet</p><br>
            </div>
           
        </div>
    </div>
    <a href="menu.php" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left"></i> Back to Menu
    <script>
        // Simple JavaScript for image thumbnail interaction
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity selector functionality
            const minusBtn = document.querySelector('.quantity-btn:first-child');
            const plusBtn = document.querySelector('.quantity-btn:last-child');
            const quantityInput = document.querySelector('.quantity-input');
            
            minusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });
            
            plusBtn.addEventListener('click', function() {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
            });

            // Add to cart functionality
            document.querySelector('.add-to-cart').addEventListener('click', function() {
                const productName = this.getAttribute('data-name');
                const productPrice = this.getAttribute('data-price');
                const quantity = document.querySelector('.quantity-input').value;

                fetch('add_to_cart.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        'product_name': productName,
                        'product_price': productPrice,
                        'quantity': quantity
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>
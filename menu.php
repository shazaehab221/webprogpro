
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

    header("Location: menu.php"); // Redirect to cart page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Bakery Menu</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="logo12.png" alt="Logo">
                <h1>crusty&nutsy</h1>
            </div>
            <ul class="nav-links">
                <li><a href="test1.php">Home</a></li>
                <li><a href="#menu" class="active">Our Menu</a></li>
               <li> <a href="card.php" class="nav-link">
    <i class="bi bi-cart4 fs-3"></i></a></li>
                
                
            </ul>
        </nav>
    </header>

    <h2>OUR MENU</h2>
    
    <div class="menu-section">
        <div class="food-category">
            <h3>CROISSANTS</h3>
            <div class="card-container">
                <div class="card"  onclick="window.location.href='pp.php?'">
                    <img src="choccr.jpg" alt="Chocolate Croissant" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Chocolate Croissant</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.5</span>
                        </div>
                        <p class="card-desc">Flaky, buttery croissant filled with rich dark chocolate.</p>
                        <div class="card-price">50 EGP</div>
                        <button class="add-to-cart">Add to cart</button>
                    </div>
                </div>

                <div class="card">
                    <img src="pcr.jpg" alt="Plain Croissant" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Classic Butter Croissant</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>4.0</span>
                        </div>
                        <p class="card-desc">Traditional French croissant with layers of golden, buttery pastry.</p>
                        <div class="card-price">70 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="Classic Butter Croissant">
                            <input type="hidden" name="price" value="70">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <img src="rollcr.jpg" alt="Rolled Croissant" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Almond Roll Croissant</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>5.0</span>
                        </div>
                        <p class="card-desc">Rolled croissant filled with almond cream and topped with sliced almonds.</p>
                        <div class="card-price">60 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="Almond Roll Croissant">
                            <input type="hidden" name="price" value="60">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="food-category">
            <h3>TARTS</h3>
            <div class="card-container">
                <div class="card">
                    <img src="choctr.jpg" alt="Chocolate Tart" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Chocolate Ganache Tart</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>5.0</span>
                        </div>
                        <p class="card-desc">Rich dark chocolate ganache in a crisp shortcrust pastry.</p>
                        <div class="card-price">65 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="Chocolate Ganache Tart">
                            <input type="hidden" name="price" value="65">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <img src="strtr.jpg" alt="Strawberry Tart" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Fresh Strawberry Tart</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.7</span>
                        </div>
                        <p class="card-desc">Seasonal strawberries on vanilla pastry cream with buttery crust.</p>
                        <div class="card-price">70 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="Fresh Strawberry Tart">
                            <input type="hidden" name="price" value="70">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <img src="cremetr.jpg" alt="Creme Tart" class="card-img">
                    <div class="card-content">
                        <div class="card-title">French Lemon Tart</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>4.0</span>
                        </div>
                        <p class="card-desc">Tangy lemon curd in a sweet shortcrust pastry, dusted with powdered sugar.</p>
                        <div class="card-price">60 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="French Lemon  Tart">
                            <input type="hidden" name="price" value="60">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="food-category">
            <h3>CREPES</h3>
            <div class="card-container">
                <div class="card">
                    <img src="choccrepe.jpg" alt="Chocolate Crepe" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Chocolate Dream Crepe</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.6</span>
                        </div>
                        <p class="card-desc">Thin crepe filled with melted chocolate and fresh berries.</p>
                        <div class="card-price">80 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="Chocolate Dream Crepe">
                            <input type="hidden" name="price" value="80">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <img src="icecreamcr.jpg" alt="Ice Cream Crepe" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Ice Cream Sundae Crepe</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>5.0</span>
                        </div>
                        <p class="card-desc">Warm crepe with vanilla ice cream, chocolate sauce, and whipped cream.</p>
                        <div class="card-price">90 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="ice cream Crepe">
                            <input type="hidden" name="price" value="90">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <img src="jamcrepe.jpg" alt="Jam Crepe" class="card-img">
                    <div class="card-content">
                        <div class="card-title">Berry Jam Crepe</div>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>4.0</span>
                        </div>
                        <p class="card-desc">Classic crepe filled with homemade mixed berry jam.</p>
                        <div class="card-price">65 EGP</div>
                        <form method="POST" action="menu.php" class="add-to-cart-form">
                           <input type="hidden" name="name" value="Berry Jam Crepe">
                            <input type="hidden" name="price" value="65">
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" name="add_to_cart" class="add-to-cart">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="cute_12.png" alt="Logo" class="do2">
    <footer>
        <div class="social-icons">
            <a href="#" class="social-icon facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-icon twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon tiktok">
                <i class="fab fa-tiktok"></i>
            </a>
            <a href="#" class="social-icon pinterest">
                <i class="fab fa-pinterest-p"></i>
            </a>
        </div>
        </footer>
    
</body>
</html>
<?php
session_start();

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

// Handle item deletion by product name
if (isset($_POST['delete_item']) && isset($_POST['item_id'])) {
    $id = $_POST['item_id'];
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->execute([$id]);
    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch cart items
$stmt = $pdo->query("SELECT * FROM cart");
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate subtotal
$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="test1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <header>
    <nav class="navbar">
        <div class="logo">
            <img src="logo12.png" alt="Logo">
            <h1>crusty&nutsy</h1>
        </div>
        <ul class="nav-links">
            <li><a href="test1.php">Home</a></li>
            <li><a href="menu.php" class="nav-link">Our Menu</a></li>
            <li><a href="login.php" class="nav-link">
                <i class="bi bi-person-fill fs-3"></i></a></li>
                <a href="card.php" class="active">
    <i class="bi bi-cart4 fs-3"></i> <!-- fs-1 to fs-6 (1 is biggest) -->
  </a>
        </ul>
    </nav>
</header>

<img src="cute_12.png" alt="Logo" class="do2">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            
        }
        
        .order-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .order-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .order-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .order-title {
            font-size: 24px;
            color: #333;
            margin: 0 0 5px 0;
        }
        
        
        
        .info-row {
            display: flex;
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            width: 120px;
            color: #555;
        }
        
        .info-value {
            color: #333;
        }
        
        .status {
            display: inline-block;
            padding: 5px 10px;
            background-color: #e1f5e8;
            color: #2e7d32;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 15px;
        }
        
        .total-summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        
        .status {
            display: inline-block;
            padding: 5px 10px;
            background-color: #e1f5e8;
            color: #2e7d32;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 15px;
        }
        .delete-btn {
            color: #dc3545;
            background: none;
            border: none;
            cursor: pointer;
        }
        .delete-btn:hover {
            color: #b02a37;
        }
    </style>
</head>
<body>
    <div class="order-container">
        <div class="order-card">
            <div class="order-header">
                <h1 class="order-title">Your Cart</h1>
            </div>
            
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price (EGP)</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= number_format($item['price'], 2) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                    <button type="submit" name="delete_item" class="delete-btn" 
                                            onclick="return confirm('Are you sure you want to remove this item?')">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="total-summary">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label">Subtotal:</span>
                            <span class="info-value"><?= number_format($subtotal, 2) ?> EGP</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Shipping:</span>
                            <span class="info-value">50.00 EGP</span>
                        </div>
                        <div class="info-row" style="font-size: 1.2em; font-weight: bold;">
                            <span class="info-label">Total:</span>
                            <span class="info-value"><?= number_format($subtotal + 50, 2) ?> EGP</span>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
    <button class="btn btn-primary btn-lg" onclick="placeOrder()">Proceed to Checkout</button>
    <!-- Success message will appear below the button -->
    <div id="order-message" class="mt-3"></div>
</div>
                </div>
            </div>
            
            <div class="status">
                Ready for checkout
            </div>
        </div>
    
    </div>
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
    <!-- Bootstrap Icons for trash icon -->
    <script>
function placeOrder() {
    // Create the success message
    const messageDiv = document.getElementById('order-message');
    messageDiv.innerHTML = `
        <div class="alert alert-success d-flex align-items-center" role="alert" style="padding: 12px; border-radius: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div>
                <strong>Order Successful!</strong><br>
                Your order #${Math.floor(1000 + Math.random() * 9000)} has been placed.
                <div class="small text-muted">Confirmation will be sent to your email.</div>
            </div>
        </div>
    `;
    
    // Update the checkout button
    const checkoutBtn = document.querySelector('.btn-primary');
    checkoutBtn.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i> Order Complete';
    checkoutBtn.classList.remove('btn-primary');
    checkoutBtn.classList.add('btn-success');
    checkoutBtn.disabled = true;
    
    // Optional: Add animation to the message
    messageDiv.style.opacity = 0;
    messageDiv.style.transition = 'opacity 0.5s ease';
    setTimeout(() => { messageDiv.style.opacity = 1; }, 10);
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
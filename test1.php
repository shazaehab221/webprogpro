<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crusty & Nutsy</title>
    <link rel="stylesheet" href="test1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>
<body>
    
        <nav class="navbar">
            <div class="logo">
                <img src="logo12.png" alt="Logo">
                <h1>crusty&nutsy</h1>
            </div>
            <ul class="nav-links">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#menu">Our Menu</a></li>
                <li><a href="#testimonials">Testimonials</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="login.php" class="nav-link">
                <i class="bi bi-person-fill fs-3"></i></a></li>
                <li>
  <a href="card.php" class="nav-link">
    <i class="bi bi-cart4 fs-3"></i> <!-- fs-1 to fs-6 (1 is biggest) -->
  </a>
</li>
            </ul>
        </nav>
    
    </header>

    <section id="home">
        <h1>ORDER WITH EASE</h1>
        <h5>CRUSTY & NUTSY AT YOUR HAND</h5>
        <button onclick="window.location.href='menu.php'" type="button" class="btn btn-danger">ORDER NOW!</button>

    </section>

    <section class="inline-about" id="about">
        <img src="caffe.jpg" alt="Bakery" id="about-image">
        <h2 class="about-heading">About Us</h2>
        <p class="about-text">Welcome to Crusty & Nutsy, your ultimate destination for delightful bakery and patisserie treats. Our website offers an enhanced user experience, making it easy to browse our menu, place orders, and get in touch with us. Enjoy the finest selection of baked goods right at your fingertips.</p>
    </section>

    <section id="menu">
        <h2 class="header">Our Menu</h2>
        <div class="menu-cards">
            <!-- Croissant Card -->
            <div class="menu-card">
                <h2>croissants</h2>
                <img src="croissants.jpg" alt="Croissant" class="menu-image">
                <p>Enjoy flaky, buttery croissants made with the finest ingredients.</p>
            </div>
            
            <!-- Tart Card -->
            <div class="menu-card">
                <h2>tarts</h2>
                <img src="tarts.jpg" alt="Tart" class="menu-image">
                <p>Experience the delightful taste of our handcrafted tarts, made with fresh, seasonal fruit and a buttery, flaky crust.</p>
            </div>
            
            <!-- Crepe Card -->
            <div class="menu-card">
                <h2>crepes</h2>
                <img src="crepes.jpg" alt="Crepe" class="menu-image">
                <p>Treat yourself to the irresistible charm of traditional crepes, skillfully crafted and bursting with flavors.</p>
            </div><br>
            <input type="button" value="Open menu" class="btn btn-danger" onclick="window.location.href='menu.php'">
    </section>

    <section id="testimonials">
        <h2 class="header2">Testimonials</h2>
        <div class="testimonials-container">
            <!-- Testimonial 1 -->
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <img src="ganna.jpg" alt="Carma" class="customer-image">
                <p>Fantastic service! I am extremely pleased with the results.</p>
                </div>
                <div class="rating">⭐⭐⭐⭐⭐⭐</div>
                <div class="customer-info">
                    <div class="customer-name">ganna</div>
                    <div class="customer-title">Satisfied Customer</div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <img src="maria.jpg" alt="Carma" class="customer-image">
                    <p>A fantastic platform! Quickly contacted support for a custom order, and they were incredibly accommodating.</p>
                </div>
                <div class="rating">⭐⭐⭐⭐⭐</div>
                <div class="customer-info">
                    <div class="customer-name">maria</div>
                    <div class="customer-title">Happy Customer</div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="testimonial-card">
    
                <div class="testimonial-content">
                    <img src="aya.jpg" alt="Carma" class="customer-image">
                    <p>My go-to for food ordering. The flexibility to choose from different menus is unmatched!</p>
                </div>
                
                <div class="rating">⭐⭐⭐⭐ </div>
                <div class="customer-info">
                    <div class="customer-name">aya</div>
                    <div class="customer-title">Frequent User</div>
                </div>
            </div>
    </section>
    
    
   

    <?php
$host = "localhost";
$dbname = "web";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$showToast = false;

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please fill in all fields with valid data.');</script>";
    } else {
        try {
            $sql = "INSERT INTO contact (message, name, email) VALUES (:message, :name, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':message' => $message,
                ':name' => $name,
                ':email' => $email
            ]);

            $showToast = true;
        } catch (PDOException $e) {
            echo "<script>alert('Database error: " . $e->getMessage() . "');</script>";
        }
    }
}
?>



<!-- Contact Section -->
<section id="contact">
    <div class="container d-flex justify-content-center align-items-center">
        <img src="cute_12.png" alt="Logo" class="do2">
        <img src="logo12.png" alt="Logo" class="do1">

        <!-- Display Success or Error Message -->
        <?php
        if (isset($_GET['message'])) {
            echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>

        <!-- FORM -->
        <form method="POST" action="#contact">
            <h1 class="title text-center mb-4">Contact Us</h1>

            <!-- Name -->
            <div class="form-group position-relative">
                <label for="formName" class="d-block">
                    <i class="icon" data-feather="user"></i>
                </label>
                <input type="text" id="formName" name="name" class="form-control form-control-lg thick" 
                       placeholder="Name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
            </div>

            <!-- E-mail -->
            <div class="form-group position-relative">
                <label for="formEmail" class="d-block">
                    <i class="icon" data-feather="mail"></i>
                </label>
                <input type="email" id="formEmail" name="email" class="form-control form-control-lg thick" 
                       placeholder="E-mail" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>

            <!-- Message -->
            <div class="form-group message">
                <textarea id="formMessage" name="message" class="form-control form-control-lg" rows="7" 
                          placeholder="Message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>

            <!-- Submit btn -->
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Send message</button>
            </div>
        </form>
    </div>
</section>
<!-- Toast Message -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Message submitted successfully!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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

        <?php if ($showToast): ?>
<script>
    window.onload = function() {
        var toastEl = document.getElementById('successToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    };
</script>
<?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
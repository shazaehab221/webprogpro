
<?php
// Database connection (PDO)
$host = "localhost";
$dbname = "web"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
$message = ''; // To store feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sign Up
    if (isset($_POST['signup'])) {
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $password = htmlspecialchars(trim($_POST['password'] ?? ''));
        $confirmPassword = htmlspecialchars(trim($_POST['confirm_password'] ?? ''));

        if (empty($email) || empty($password) || empty($confirmPassword) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $password !== $confirmPassword) {
            $message = "Please fill in all fields correctly, and make sure the passwords match.";
        } else {
            try {
                $sql = "INSERT INTO users (email, password, name) VALUES (:email, :password, :name)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':name' => $name,
                    ':email' => $email
                ]);
                $message = "You have successfully signed up!";
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        }
    }

    // Login
    if (isset($_POST['login'])) {
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars(trim($_POST['password'] ?? ''));

        if (empty($email) || empty($password)) {
            $message = "Please fill in both fields.";
        } else {
            try {
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    $message = "Welcome back, " . htmlspecialchars($user['name']) . "!";
                    // Here you can start a session if needed
                } else {
                    $message = "Invalid credentials. Please try again.";
                }
            } catch (PDOException $e) {
                $message = "Error: " . $e->getMessage();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="test1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    * {
  box-sizing: border-box;
}


body {
  background:rgba(53, 1, 39, 0.3);
  font-family: 'Lato', sans-serif;
}

a {
  text-decoration: none;
  color: black;
}

.panel {
  width: 600px;
  margin: auto;
}
.panel__menu {
  width: 100%;
  float: left;
  margin: 20px 0 30px;
  position: relative;
}
.panel__menu.second-box hr {
  -webkit-transform: translateX(325%);
          transform: translateX(325%);
}
.panel__menu hr {
  position: absolute;
  top: 100%;
  width: 20%;
  -webkit-transform: translateX(75%);
          transform: translateX(75%);
  border: none;
  background:rgb(197, 170, 241);
  height: 1px;
  margin: 0;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}
.panel__menu li {
  width: 50%;
  text-align: center;
  float: left;
  cursor: pointer;
}
.panel__menu li a {
  color: #fff;
  display: inline-block;
  padding: 17px 30px;
  text-transform: uppercase;
}
.panel__wrap {
  width: 100%;
  float: left;
  position: relative;
}
.panel__wrap .panel__box label {
  opacity: 0;
}
.panel__wrap .panel__box:first-child {
  left: 0;
  -webkit-transform: translateX(30%) scale(0.8);
          transform: translateX(30%) scale(0.8);
  -webkit-animation: box-1--out 0.5s;
          animation: box-1--out 0.5s;
  -webkit-transform-origin: center right;
          transform-origin: center right;
}
.panel__wrap .panel__box:first-child.active {
  -webkit-transform: translateX(35%);
          transform: translateX(35%);
  -webkit-animation: box-1 0.5s;
          animation: box-1 0.5s;
}
.panel__wrap .panel__box:last-child {
  right: 0;
  -webkit-transform: translateX(-30%) scale(0.8);
          transform: translateX(-30%) scale(0.8);
  -webkit-animation: box-2--out 0.5s;
          animation: box-2--out 0.5s;
  -webkit-transform-origin: center left;
          transform-origin: center left;
}
.panel__wrap .panel__box:last-child input[type="submit"] {
  background: none;
  border: 1px solidrgb(228, 247, 192);
  color:#4a0638;
}
.panel__wrap .panel__box:last-child.active {
  -webkit-animation: box-2 0.5s;
          animation: box-2 0.5s;

  -webkit-transform: translateX(-35%);
          transform: translateX(-35%);
}
.panel__box {
  width: 50%;
  float: left;
  z-index: 1;
  background: pink;
  position: absolute;
  padding: 20px;
  background:rgb(7, 1, 73);
  border-radius: 4px;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}
.panel__box.active {
  background: #fff;
  z-index: 2;
}
.panel__box.active label, .panel__box.active input {
  opacity: 1;
}
.panel__box label {
  float: left;
  width: 100%;
  margin-bottom: 20px;
  color: #4a0638;;
}
.panel__box input {
  outline: none;
  opacity: 0;
}
.panel__box input[type="email"], .panel__box input[type="password"],.panel__box input[type="name"] {
  margin-top: 10px;
  width: 100%;
  float: left;
  background: #EEF9FE;
  border: 1px solid #CDDBEF;
  border-radius: 3px;
  padding: 7px 10px;
}
.panel__box input[type="submit"] {
  float: right;
  cursor: pointer;
  border: none;
  padding: 11px 40px;
  background: #4a0638;;
  border-radius: 30px;
  color: #fff;
}

@-webkit-keyframes box-1 {
  0% {
    -webkit-transform: translateX(30%) scale(0.8);
            transform: translateX(30%) scale(0.8);
    z-index: 1;
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
    label, input {
      opacity: 0;
    }
  }
  100% {
    -webkit-transform: translateX(35%) scale(1);
            transform: translateX(35%) scale(1);
    z-index: 2;
    label, input {
      opacity: 1;
    }
  }
}

@keyframes box-1 {
  0% {
    -webkit-transform: translateX(30%) scale(0.8);
            transform: translateX(30%) scale(0.8);
    z-index: 1;
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
    label, input {
      opacity: 0;
    }
  }
  100% {
    -webkit-transform: translateX(35%) scale(1);
            transform: translateX(35%) scale(1);
    z-index: 2;
    label, input {
      opacity: 1;
    }
  }
}
@-webkit-keyframes box-1--out {
  0% {
    -webkit-transform: translateX(35%) scale(1);
            transform: translateX(35%) scale(1);
    z-index: 2;
    label {
      opacity: 1;
    }
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
    label, input {
      opacity: 1;
    }
  }
  100% {
    -webkit-transform: translateX(30%) scale(0.8);
            transform: translateX(30%) scale(0.8);
    z-index: 1;
    label, input {
      opacity: 0;
    }
  }
}
@keyframes box-1--out {
  0% {
    -webkit-transform: translateX(35%) scale(1);
            transform: translateX(35%) scale(1);
    z-index: 2;
    label {
      opacity: 1;
    }
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
    label, input {
      opacity: 1;
    }
  }
  100% {
    -webkit-transform: translateX(30%) scale(0.8);
            transform: translateX(30%) scale(0.8);
    z-index: 1;
    label, input {
      opacity: 0;
    }
  }
}
@-webkit-keyframes box-2 {
  0% {
    -webkit-transform: translateX(-30%) scale(0.8);
            transform: translateX(-30%) scale(0.8);
    z-index: 1;
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
    label, input {
      opacity: 0;
    }
  }
  100% {
    -webkit-transform: translateX(-35%) scale(1);
            transform: translateX(-35%) scale(1);
    z-index: 2;
    label, input {
      opacity: 1;
    }
  }
}
@keyframes box-2 {
  0% {
    -webkit-transform: translateX(-30%) scale(0.8);
            transform: translateX(-30%) scale(0.8);
    z-index: 1;
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
    label, input {
      opacity: 0;
    }
  }
  100% {
    -webkit-transform: translateX(-35%) scale(1);
            transform: translateX(-35%) scale(1);
    z-index: 2;
    label, input {
      opacity: 1;
    }
  }
}
@-webkit-keyframes box-2--out {
  0% {
    -webkit-transform: translateX(-35%) scale(1);
            transform: translateX(-35%) scale(1);
    z-index: 2;
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
    label, input {
      opacity: 1;
    }
  }
  100% {
    -webkit-transform: translateX(-30%) scale(0.8);
            transform: translateX(-30%) scale(0.8);
    z-index: 1;
    label, input {
      opacity: 0;
    }
  }
}
@keyframes box-2--out {
  0% {
    -webkit-transform: translateX(-35%) scale(1);
            transform: translateX(-35%) scale(1);
    z-index: 2;
  }
  49% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 2;
  }
  50% {
    -webkit-transform: translateX(0) scale(0.9);
            transform: translateX(0) scale(0.9);
    z-index: 1;
    label, input {
      opacity: 1;
    }
  }
  100% {
    -webkit-transform: translateX(-30%) scale(0.8);
            transform: translateX(-30%) scale(0.8);
    z-index: 1;
    label, input {
      opacity: 0;
    }
  }
}


@-webkit-keyframes square {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
  }
}
@keyframes square {
  0% {
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
  100% {
    -webkit-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
  }
}
</style>

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
            <li><a href="menu.php">Our Menu</a></li>
            <li><a href="login.php" class="active">
                <i class="bi bi-person-fill fs-3"></i></a></li>
                <a href="card.php" class="nav-link">
    <i class="bi bi-cart4 fs-3"></i> <!-- fs-1 to fs-6 (1 is biggest) -->
  </a>
                
        </ul>
    </nav>
</header>

<img src="cute_12.png" alt="Logo" class="do2">
<?php if (!empty($message)): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($message) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<!-- Form with error/success messages -->
<div class="panel">
    <ul class="panel__menu" id="menu">
      <hr/>
      <li id="signIn"> <a href="#">Login</a></li>
      <li id="signUp"><a href="#">Sign up</a></li>
    </ul>
    <div class="panel__wrap">
      <!-- Login Form -->
      <div class="panel__box active" id="signInBox">
        <form action="" method="POST">
          
        <label>Email
            <input type="email" name="email" required />
          </label>
          <label>Password
            <input type="password" name="password" required />
          </label>
          <input type="submit" name="login" value="Login" />
        </form>
      </div>
      <!-- Sign Up Form -->
      <div class="panel__box" id="signUpBox">
        <form action="" method="POST">
        <label>name
            <input type="name" name="name" required />
          </label>
          <label>Email
            <input type="email" name="email" required />
          </label>
          <label>Password
            <input type="password" name="password" required />
          </label>
          <label>Confirm password
            <input type="password" name="confirm_password" required />
          </label>
          <input type="submit" name="signup" value="Sign Up"  />
        </form>
      </div>
    </div>
  </div>
  
</div>

</body>


<script>
var menu = document.getElementById("menu"),
    panelMenu = menu.querySelectorAll("li"),
    panelBoxes = document.querySelectorAll(".panel__box"),
    signUp = document.getElementById("signUp"),
    signIn = document.getElementById("signIn");

function removeSelection() {
  for (var i = 0, len = panelBoxes.length; i < len; i++) {
    panelBoxes[i].classList.remove("active");
  }
}

signIn.onclick = function(e) {
  e.preventDefault();
  removeSelection();
  panelBoxes[0].classList.add("active");
  menu.classList.remove("second-box");
};

signUp.onclick = function(e) {
  e.preventDefault();
  removeSelection();
  panelBoxes[1].classList.add("active");
  menu.classList.add("second-box");
};

</script>
</body>

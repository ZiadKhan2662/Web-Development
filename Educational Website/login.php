<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <title>Educational Website</title>
</head>
<body>
    <?php
    session_start();


    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "web_development";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Process login form data when form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM Registration WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user['email'];
            header('location: index.html');
        } else {
            echo "<script>alert('Invalid login credentials')</script>";
        }
    }
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <!-- <p><span>*</span></p> -->
            <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
            <!-- <p><span>*</span></p> -->
            <input type="password" name="password" placeholder="Enter your password" required maxlength="20" class="box">
            
                <button type="submit" name="submitLogin" class="custom-submit-button">Login</button>
                <br><h4>Don't have account? <a href="register.php">Register here</a></h4>
        </form>
    </div>
</body>
</html>
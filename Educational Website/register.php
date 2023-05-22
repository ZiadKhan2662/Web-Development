<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    
    <title>Web Development</title>
</head>
<body>
  
<?php
// Initialize variables to null
$name = $email = $password = $confirm_password = '';
$name_err = $email_err = $password_err = $confirm_password_err = '';

// Processing form data when form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Validate name
    if(empty(trim($_POST['name']))){
        $name_err = 'Please enter your name.';
    } else {
        $name = trim($_POST['name']);

        if(!preg_match("/^[a-zA-Z ]*$/", $name)){
            $name_err = 'Name can only contain letters and white space.';
        }
    }

    // Validate email
    if(empty(trim($_POST['email']))){
        $email_err = 'Please enter your email address.';
    } else {
        $email = trim($_POST['email']);
        // Check if email address is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_err = 'Invalid email address.';
        }
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter a password.';
    } elseif(strlen(trim($_POST['password'])) < 8){
        $password_err = 'Password must have at least 8 characters.';
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST['Cpassword']))){
        $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['Cpassword']);
        if($password != $confirm_password){
            $confirm_password_err = 'Passwords did not match.';
        }
    }

    // If there are no input errors, insert user into database
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Create database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "web_development";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $username = $_POST['name'];
            $workEmail = $_POST['email'];
            $phone_num = $_POST['password'];

            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO Registration (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $username);
            $stmt->bindParam(':email', $workEmail);
            $stmt->bindParam(':password', $phone_num);
            $stmt->execute();

            header("Location: login.php");
            exit();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    }
}
?>
    
        <div class="form-container">
        <form action="" name="myForm" value ="1" method="POST" onsubmit="return validate()">
            <h3>Register Now</h3>
            <span class="error-message" id="name-error" style="color: red;"><?php echo "".$name_err?></span>
            <input type="text" name="name" placeholder="Your Name" maxlength="50" class="box">
            <span class="error-message" id="email-error" style="color: red;"><?php echo "".$email_err?></span>
            <input type="email" name="email" placeholder="Your Email"  maxlength="50" class="box">
            <span class="error-message" id="password-error" style="color: red;"><?php echo "".$password_err?></span>
            <input type="password" name="password" placeholder="Your Password"  maxlength="20" class="box">
            <span class="error-message" id="Cpassword-error" style="color: red;"><?php echo "".$confirm_password_err?></span>
            <input type="password" name="Cpassword"placeholder="Confirm Password" maxlength="20" class="box">
            <p>select profile <span>*</span></p>
            <input type="hidden" name="form_submitted" value="1" />
            <input type="file" accept="image/*" class="box">
                <input type="submit" value="Register" name="submit" class="custom-submit-button"></input>
                <br><h4>Want to login? <a href="login.php">Login here</a></h4>  
        </form>
    </div>
</body>
<script src="C:\xampp\htdocs\Educational Website\javascipt.js"></script>
</html>
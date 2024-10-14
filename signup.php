<?php
include("connection.php");

if(isset($_POST["register"])) {
    $username = $_POST['name'];
    $mail = $_POST['email'];
    $pass = $_POST['pass'];
    $confirm = $_POST['conpass'];

    $check_query = "SELECT * FROM user WHERE email = '$mail'";
    $check_result = mysqli_query($database, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        echo "Email is already taken";
    } else {
        $errors = array();

        if (empty($username)) {
            $errors[] = "Username is required";
        }
        if (empty($mail)) {
            $errors[] = "Email is required";
        }
        if (empty($pass)) {
            $errors[] = "Password is required";
        }
        if (empty($confirm)) {
            $errors[] = "Confirm password is required";
        } elseif ($pass != $confirm) {
            $errors[] = "Password does not match the confirm password";
        } elseif (strlen($pass) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        } elseif (!preg_match("/[a-z]/i", $pass)) {
            $errors[] = "Password must contain at least one letter";
        }

        if (empty($errors)) {
            $insert_query = "INSERT INTO user (id, name, email, pass) VALUES (NULL, '$username', '$mail', '$pass')";
            $insert_result = mysqli_query($database, $insert_query);
            if ($insert_result) {
                echo "<script>alert('User registered successfully')</script>";
                header('Location: products.php');
                exit();
            } else {
                echo "Error: Failed to register user";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <link rel="icon" type="image/x-icon" href="9hmlbmpehls8nq1e3boq1f66jd.png">
    <title>SignUp</title>
</head>
<body style="background-image: url(contact.jpg);
    background-size: cover;
    background-repeat: no-repeat;">
   <fieldset>
   <h1>Sign up</h1>
   <form method="post">
        <div class="sign">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="your name"> <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="xyz@gmail.com"> <br>
        <label for="pass"  style="margin-right:-9px;">Password:</label>
        <input type="password" id="pass" name="pass" placeholder="your password"><br>
        <label for="conpass" style="margin-right:-82px;">Confirm Password:</label>
        <input type="password" id="conpass" name="conpass" placeholder="your confirm password"><br>
        <button type="submit" name="register">SignUp</button>
        <p>Already have an acount? <a href="login.php">Login</a></p>
</div>
    </form>
   </fieldset>
   
</body>
</html>
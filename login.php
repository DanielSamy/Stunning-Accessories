<?php
include("connection.php");

$errors = array();

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($database, $_POST['email']);
    $password = mysqli_real_escape_string($database, $_POST['pass']);

    if(empty($email)) {
        array_push($errors, "Email is required");
    }
    if(empty($password)) {
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0) {
        $query = "SELECT * FROM user WHERE email = '$email' AND pass = '$password'";
        $result = mysqli_query($database, $query);

        if(mysqli_num_rows($result) == 1) {

            if($email == "daniel@gmail.com" && $password == "daniel1234") {
                header('Location: allrecords.php');
                exit();
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "Welcome, you are logged in";
                header('Location: products.php');
                exit();
            }
        } else {
            array_push($errors, "Incorrect Email or Password");
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="icon" type="image/x-icon" href="9hmlbmpehls8nq1e3boq1f66jd.png">
        <style>
            body{
                background-image: url(contact.jpg);
                background-size: 1200px;
            }
            form legend{
                text-align: center;
                font-weight: bolder;
                font-size: 30px;
                font-family: serif;
            }
            form{
                margin: 25px 30px;
                width: 400px;
            }
            form input{
                margin: 10px;
                padding: 10px;
                border-radius: 8%;
            }
            form label{
                font-weight: bold;
                
            }
            form a{
                float: right;
            }
            form button{
                width: 90%;
                background-color: black;
                color: white;
                display: inline-block;
                margin: 10px 0 0 20px ;
                padding: 9px;
                font-weight: bold;
                font-size: 15px;
                border: 2px solid snow;
                cursor: pointer;
            }
            form button:hover{
                background-color: burlywood;
                
            }
            fieldset{
                background-color: #EFE8DE;
                width: 500px;
                height: 250px;
            }
            #pass{
                text-decoration: none;
                color: black;
                font-family:serif;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <form method="post">
            
            <?php if(count($errors) > 0): ?>
        <div class="error">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
            <fieldset>
                <legend>Please login here</legend><br>
                <label for="email">Email</label>
                <input type="text" placeholder="Please enter your Email" size="50px" id="email" name="email"><br>
                <label for="pass">Password</label>
                <input type="password" placeholder="Please enter your password" size="50px" id="pass" name="pass"><br>
                <label><input type="checkbox">Remeber Me</label>
                <a id="pass" href="#"> Forgot Password</a><br>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="signup.php" style="text-decoration:none; color:black;">Sign Up</a></p>
            </fieldset>
        </form>
    </body>
</html>
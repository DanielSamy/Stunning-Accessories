<?php
include('connection.php');
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['add'])) {
    $productName = mysqli_real_escape_string($database, $_POST['productName']);
    $description = mysqli_real_escape_string($database, $_POST['description']);
    $price = mysqli_real_escape_string($database, $_POST['price']);
    $image = mysqli_real_escape_string($database, $_POST['image']);
    $insert = "insert into product (id, productName, description, price, image) values(Null, '$productName','$description','$price', '$image')";
    $run_insert=mysqli_query($database, $insert);
    header("location:allrecords.php");
}

?>

<html>
<head>
    <link rel="stylesheet" href="./add.css">
    <title>Add Product</title>
</head>
<body>
<h1>Add Product</h1>
<form method="post">
    <div class="form">
        <label for="productName">Product name</label>
        <input type="text" placeholder="Ex.braclet" name="productName" id="productName" required>
    </div>
    <div class="form">
        <label for="description">Description</label>
        <input type="text" placeholder="Enter Description" name="description" id="description" required>
    </div>           
    <div class="form">
        <label for="price">Price</label>
        <input type="text" placeholder="Enter price" name="price" id="price" required>
    </div> 
    <div class="img">
        <label for="image">Enter the image</label>
        <input type="file" placeholder="Chose File" name="image" id="image" required>
    </div>
    <div class="btn">
        <button type="submit" name="add">Add</button>
    </div>
</form>
</body>
</html>
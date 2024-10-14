<?php
include("connection.php");

$id = $_GET['id'];
$selectQry = mysqli_query($database, "SELECT * FROM product WHERE id = '$id' ");
$data = mysqli_fetch_array($selectQry);

if(isset($_POST['update'])){
  $productName = $_POST['productName'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $updateQry = "UPDATE product SET productName='$productName', description='$description', price='$price', image = '$image' WHERE id='$id'";
  $edit = mysqli_query($database, $updateQry);

  if($edit){
    mysqli_close($database);
    header("location:allrecords.php");
  }else{
    echo mysqli_error($database);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./update.css">
  <title>Update products</title>
</head>
<body>
  <h1>Update Product</h1>
  <form method="POST">
    <div class="form">
      <label for="productName">Product Name </label>
      <input id="productName" type="text" name="productName" value="<?php echo $data['productName'] ?>" placeholder="Ex.Bracelet" required>
    </div>
    <div class="form">
      <label for="description">Description </label>
      <input id="description" type="text" name="description" value="<?php echo $data['description']?>">
    </div>
    <div class="form">
      <label for="price">Price </label>
      <input id="price" type="number" name="price" value="<?php echo $data['price']?>">
    </div>
    <div class="img">
    <label for="image">Enter the image</label>
      <input type="file" name="image" value=" <?php echo $data['image']?>">
    </div>
    <div class="btn">
        <button type="submit" name="update">Update</button>
    </div>
  </form>
</body>
</html>

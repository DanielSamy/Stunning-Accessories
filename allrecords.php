<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="allrec.css">
  <title>Stunning Accessories | Products</title>
</head>
<body>
  <table border="1" style="width:80%; margin-left:10%;">
  <tr>
      <td colspan="7" class="title">
        Product Details
      </td>
    </tr>
    <tr style="font-size:22px;text-align:center;" >
      <td class="thead">ID</td>
      <td class="thead">Product name</td>
      <td class="thead">Description</td>
      <td class="thead">Price</td>
      <td class="thead">Image</td>
      <td class="thead">Update</td>
      <td class="thead">Delete</td>
    </tr>
    <?php
    $records = mysqli_query($database, "SELECT * FROM product");
    while ($data = mysqli_fetch_array($records)) {
    ?>
    <tr style="font-size:20px;">
      <td><?php echo $data['id']; ?></td>
      <td><?php echo $data['productName']; ?></td>
      <td><?php echo $data['description']; ?></td>
      <td><?php echo $data['price']; ?></td>
      <td><img src="images/<?php echo $data['image'];?>" height="150px" width="150px"></td>
      <td style="background-color: white;"><a href="update.php ? id=<?php echo $data['id']; ?>">Update</a></td>
      <td style="background-color: white;"><a href="delete.php ? id=<?php echo $data['id']; ?>" name="confirm_delete" onclick="return confirmDelete();">Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </table>
  <br>
  <strong><p style="text-align:center; font-size:18px;">Do you want to add any other Product? <a id="click" href="add.php">Click Here</a></p></strong>
  <script>
    function confirmDelete(){
      return confirm("Are you sure you want to delete this record?");
    }
  </script>
</body>
</html>
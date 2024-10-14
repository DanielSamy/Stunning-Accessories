<?php
include("connection.php");

$sort = '';
$searchTerm = '';

if (isset($_POST['sort'])) {
  $sort = $_POST['sort'];
}

if (isset($_POST['search'])) {
  $searchTerm = mysqli_real_escape_string($database, $_POST['search']);
}

$query = "SELECT * FROM product";

if (!empty($searchTerm)) {
  $query .= " WHERE description LIKE '%$searchTerm%'";
}

if ($sort == 'High to Low') {
  $query .= " ORDER BY price DESC";
} elseif ($sort == 'Low to High') {
  $query .= " ORDER BY price ASC";
}

$records = mysqli_query($database, $query);

if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="Logo.png">
    <title>Stunning Accessories</title>
    <link rel="stylesheet" href="Project.css">
    <style>
        .box {
            margin-top: 50px;
            display: inline-block;
            margin-left: 20px;
            margin-bottom: 10px;
        }
        #btn {
            background-color: #592720;
            height: 50px;
            width: 60px;
            color: white;
            margin-right: 2%;
            margin-top: 4%;
        }
        #btn:hover {
            background-color: white;
            font-weight: bolder;
            color: #592720;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <div id="toplinks">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Contact us.html" target="_blank">Contact us</a></li>
            <li><a href="survey.html" target="_blank">Survey</a></li>
            <li><a href="check.html" target="_blank">العربية</a></li>
        </ul>
        <img id="logo" src="Logo.png">
        <form method="post">
            <button id="btn" type="submit" name="logout">Logout</button>
        </form>
    </div>

    <div id="search">
        <form method="post">
            <input type="search" name="search" placeholder="Search for accessories..." size="70px" value="<?php echo $searchTerm; ?>">
            <input type="submit" value="Search" id="go">
        </form>
    </div>

    <div id="cart">
        <table>
            <tr>
                <td></td>
                <td>
                    <a href="#"><img src="cart.png" width="40px"></a>
                </td>
            </tr>
        </table>
    </div>
</header>

<nav>
    <ul>
        <li><a href="#">Best Sales</a></li>
        <li><a href="#">Necklaces</a></li>
        <li><a href="#">Braclets</a></li>
        <li><a href="#">Earrings</a></li>
        <li><a href="#">Rings</a></li>
        <li><a href="#">Other Products</a></li>
    </ul>
</nav>

<article>
    <form id="Leftform" method="post">
        <label>Filter by</label>
        <select name="filter">
            <option value="" disabled selected>None</option>
            <option value="Price">Price</option>
            <option value="Materials">Materials</option>
            <option value="Category">Category</option>
        </select>
        <input type="submit" value="Apply">
    </form>

    <form id="Rightform" method="post">
        <label>Sort by</label>
        <select name="sort">
            <option value="" disabled selected>None</option>
            <option value="High to Low">High to Low</option>
            <option value="Low to High">Low to High</option>
        </select>
        <input type="submit" value="Sort">
    </form>

    <table>
       <?php if (mysqli_num_rows($records) > 0) { ?>
            <?php while ($data = mysqli_fetch_array($records)) { ?>
                <td class="box">
                    <img src="images/<?php echo $data['image']; ?>" height="150px" width="150px" class="Product"><br><br>
                    <?php echo $data['description']; ?></p> <br>
                    <p><span class="Price">Price: <?php echo $data['price']; ?></span><br>
                    <a href="login.php"><img src="Add to cart.png"></a>
                </td>
            <?php } ?>
        <?php } else { ?>
            <p>No products found matching your search criteria.</p>
        <?php } ?>
    </table>
</article>

<footer>
    Copy &copy; Stunning Accessories
</footer>

</body>
</html>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'mail');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, name, price, description FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '
        <div class="product">
            <img src="'.$row["image_url"].'" alt="'.$row["name"].'">
            <h3>'.$row["name"].'</h3>
            <p>Price: $'.$row["price"].'</p>
            <a href="product.php?id='.$row["id"].'">View Details</a>
        </div>';
    }
} else {
    echo "No products found";
}
?>

<!-- <?php
session_start();
$random_code = md5(rand(0, 100));
$captcha_code = substr($random_code, 0, 6);
$_SESSION['CAPTCHA_CODE'] = $captcha_code;

header('Content-type: image/png');
$image = imagecreatetruecolor(100, 30);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, 200, 35, $background_color);
imagettftext($image, 20, 0, 10, 25, $text_color, 'path/to/font.ttf', $captcha_code);
imagepng($image);
imagedestroy($image);
?> -->
 

 <?php 
include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_name'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');  
    exit;
}

// ... (other code and function definitions)

// Adding products to the database
if (isset($_POST['add_product'])) {
    // ... (existing code to handle other form data)
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/'.$image;

    $image_uploaded = false;
    if (!empty($image)) {
        // ... (existing code to handle image upload)
        $image_uploaded = true;
    }

    if ($image_uploaded) {
        $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_detail`, `image`) VALUES ('$product_name','$product_price','$product_detail','$image')");
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_detail`) VALUES ('$product_name','$product_price','$product_detail')");
    }

    // ... (rest of the code for redirecting or handling errors)
}

// ... (other code)

// Updating product details
if (isset($_POST['updte_product'])) {
    // ... (existing code to handle form data)

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder='image/'.$update_image;

    if (!empty($update_image) && file_exists($update_image_tmp_name)) {
        // ... (existing code to handle image upload)
        $update_query = mysqli_query($conn, "UPDATE `products` SET `name`='$update_name', `price`='$update_price', `product_detail`='$update_detail', `image`='$update_image' WHERE id = '$update_id'") or die('query failed');
    } else {
        // Update without changing the image
        $update_query = mysqli_query($conn, "UPDATE `products` SET `name`='$update_name', `price`='$update_price', `product_detail`='$update_detail' WHERE id = '$update_id'") or die('query failed');
    }

    // ... (rest of the code for redirecting or handling errors)
}

// ... (rest of your existing PHP code)
?>

<!-- Your existing HTML and PHP code for the page layout -->


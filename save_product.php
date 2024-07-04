<?php
$servername = "127.0.0.1";
$username = "wessam";
$password = "/4_O6A2UiYXo-KC/";
$dbname = "sales store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// Ensure the uploads directory exists
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$contactNumber = $_POST['contactNumber'];
$productCategory = $_POST['productCategory'];
$productModel = $_POST['productModel'];
$productCondition = $_POST['productCondition'];
$productDescription = $_POST['productDescription'];

// Handle image upload
$imagePath = '';
if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == 0) {
    $imageName = basename($_FILES['productImage']['name']);
    $imagePath = $upload_dir . $imageName;

    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $imagePath)) {
        $imagePath = $imagePath;
    } else {
        die("حدث خطأ أثناء رفع الصورة.");
    }
}

$sql = "INSERT INTO tb_upload (name, image) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("خطأ في التحضير: " . $conn->error);
}

$stmt->bind_param("ss", $productName, $imagePath);

if ($stmt->execute()) {
    echo "تم إضافة المنتج بنجاح!";
} else {
    echo "خطأ: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

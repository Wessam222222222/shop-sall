<?php
// الاتصال بقاعدة البيانات
$servername = "127.0.0.1";
$username = "wessam";
$password = "/4_O6A2UiYXo-KC/";
$dbname = "sales store";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// إذا تم تقديم النموذج، قم بإضافة المنتج إلى قاعدة البيانات
if (isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $contactNumber = $_POST['contactNumber'];
    $productCategory = $_POST['productCategory'];
    $productModel = $_POST['productModel'];
    $productCondition = $_POST['productCondition'];
    $productDescription = $_POST['productDescription'];
    $productImage = $_FILES['productImage']['name'];
    $tmpName = $_FILES['productImage']['tmp_name'];
    $imagePath = 'uploads/' . $productImage;

    move_uploaded_file($tmpName, $imagePath);

    // استعداد استعلام SQL لإدراج البيانات في قاعدة البيانات
    $sql = "INSERT INTO products (productName, productPrice, contactNumber, productCategory, productModel, productCondition, productDescription, productImage)
            VALUES ('$productName', '$productPrice', '$contactNumber', '$productCategory', '$productModel', '$productCondition', '$productDescription', '$productImage')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('تم إضافة المنتج بنجاح.')</script>";
        echo "<script>window.location.href = 'view_products.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// استعلام SQL لاسترجاع الإعلانات
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الإعلانات</title>
    <!-- تضمين Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>الإعلانات المنشورة</h2>
    <div class="row">

    <?php
    // فحص إذا كانت هناك نتائج ليتم عرضها
    if ($result->num_rows > 0) {
        // عرض كل صف كمصفوفة متجهة
        while($row = $result->fetch_assoc()) {
    ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="uploads/<?php echo $row["productImage"]; ?>" class="card-img-top" alt="صورة المنتج">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["productName"]; ?></h5>
                        <p class="card-text">السعر: <?php echo $row["productPrice"]; ?></p>
                        <p class="card-text">رقم الاتصال: <?php echo $row["contactNumber"]; ?></p>
                        <p class="card-text">الفئة: <?php echo $row["productCategory"]; ?></p>
                        <p class="card-text">النموذج: <?php echo $row["productModel"]; ?></p>
                        <p class="card-text">الحالة: <?php echo $row["productCondition"]; ?></p>
                        <p class="card-text">الوصف: <?php echo $row["productDescription"]; ?></p>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>لا توجد إعلانات متاحة حاليًا.</p>";
    }
    $conn->close();
    ?>

    </div> <!-- end row -->
</div> <!-- end container -->

<!-- تضمين Bootstrap JS والمكتبات الإضافية -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

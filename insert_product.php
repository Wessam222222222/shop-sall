<?php
// التحقق من أنه تم الضغط على زر الإرسال
if(isset($_POST["submit"])) {
    // استدعاء ملف الاتصال بقاعدة البيانات
    require 'W:/XAMPP/htdocs/testite/testite/connection.php';

    // جلب البيانات من النموذج
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $contactNumber = $_POST["contactNumber"];
    $productCategory = $_POST["productCategory"];
    $productModel = $_POST["productModel"];
    $productCondition = $_POST["productCondition"];
    $productDescription = $_POST["productDescription"];

    // التحقق من وجود صورة
    if($_FILES["productImage"]["error"] == 4) {
        echo "<script> alert('الصورة غير موجودة'); </script>";
    } else {
        $fileName = $_FILES["productImage"]["name"];
        $fileSize = $_FILES["productImage"]["size"];
        $tmpName = $_FILES["productImage"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        // التحقق من امتداد الصورة
        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script> alert('امتداد الصورة غير صالح'); </script>";
        } elseif ($fileSize > 1000000) { // التحقق من حجم الصورة
            echo "<script> alert('حجم الصورة كبير جداً'); </script>";
        } else {
            // إعطاء اسم جديد للصورة
            $newImageName = uniqid() . '.' . $imageExtension;

            // نقل الصورة إلى المجلد المخصص
            move_uploaded_file($tmpName, 'W:/XAMPP/htdocs/testite/testite/img/' . $newImageName);

            // إدخال بيانات المنتج إلى قاعدة البيانات
            $query = "INSERT INTO products (productName, productPrice, contactNumber, productCategory, productModel, productCondition, productDescription, productImage)
                      VALUES ('$productName', '$productPrice', '$contactNumber', '$productCategory', '$productModel', '$productCondition', '$productDescription', '$newImageName')";

            if(mysqli_query($conn, $query)) {
                echo "<script> alert('تمت إضافة المنتج بنجاح'); document.location.href = 'data.php'; </script>";
            } else {
                echo "<script> alert('حدث خطأ أثناء إضافة المنتج'); </script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
    <style>
        /* أسلوب الاستايل هنا */
    </style>
</head>
<body>
    <h1>إضافة منتج جديد</h1>
    <form id="addProductForm" action="" method="post" enctype="multipart/form-data">
        <label for="productName">اسم المنتج:</label>
        <input type="text" id="productName" name="productName" required>
        
        <label for="productPrice">سعر المنتج:</label>
        <input type="number" id="productPrice" name="productPrice" required>
        
        <label for="contactNumber">رقم الهاتف:</label>
        <input type="text" id="contactNumber" name="contactNumber" required>
        
        <label for="productCategory">القسم:</label>
        <select id="productCategory" name="productCategory">
            <option value="vehicles">مركبات</option>
            <option value="motorcycles">دراجات نارية</option>
            <option value="houses">عقارات</option>
            <option value="electronics">إلكترونيات</option>
            <option value="laptops">لابتوب وكمبيوتر</option>
        </select>

        <label for="productModel">موديل المنتج:</label>
        <input type="text" id="productModel" name="productModel" required>
        
        <label for="productCondition">حالة المنتج:</label>
        <input type="text" id="productCondition" name="productCondition" required>
        
        <label for="productDescription">وصف المنتج:</label>
        <textarea id="productDescription" name="productDescription" rows="4" required></textarea>

        <label for="productImage">صورة المنتج:</label>
        <input type="file" id="productImage" name="productImage" accept=".jpg, .jpeg, .png" required>

        <input type="submit" name="submit" value="إضافة المنتج">
    </form>
</body>
</html>

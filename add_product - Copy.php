<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
    <style>
        /* نفس الأنماط المستخدمة في الكود السابق */
    </style>
</head>
<body>
    <h1>إضافة منتج جديد</h1>
    <form action="save_product.php" method="POST" enctype="multipart/form-data">
        <label for="productName">اسم المنتج:</label>
        <input type="text" id="productName" name="productName" required>
        
        <label for="productPrice">سعر المنتج:</label>
        <input type="number" id="productPrice" name="productPrice" required>
        
        <label for="contactNumber">رقم الهاتف:</label>
        <input type="text" id="contactNumber" name="contactNumber" minlength="8" maxlength="8" pattern="[0-9]{8}" placeholder="رقم الهاتف (8 أرقام)" required>
        
        <label for="productCategory">القسم:</label>
        <select id="productCategory" name="productCategory">
            <option value="vehicles">مركبات</option>
            <option value="motorcycles">دراجات نارية</option>
            <option value="houses">منازل</option>
            <option value="electronics">إلكترونيات</option>
            <option value="laptops">لابتوب وكمبيوتر</option>
        </select>

        <label for="productModel">موديل المنتج:</label>
        <input type="text" id="productModel" name="productModel" required>
        
        <label for="productCondition">حالة المنتج:</label>
        <input type="text" id="productCondition" name="productCondition" required>
        
        <label for="productDescription">وصف المنتج:</label>
        <textarea id="productDescription" name="productDescription" rows="4" required></textarea>

        <label for="productImage">صور المنتج:</label>
        <input type="file" id="productImage" name="productImage[]" accept="image/*" multiple required>
        
        <input type="submit" value="إضافة المنتج">
    </form>
</body>
</html>

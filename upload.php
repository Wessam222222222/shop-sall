<?php
$uploadDirectory = '/المسار/المجلد/المحلي/'; // تحديد مسار المجلد المحلي

if (!empty($_FILES['productImage']['name'][0])) {
    $uploadedFiles = $_FILES['productImage'];

    foreach ($uploadedFiles['name'] as $key => $fileName) {
        $fileTmpName = $uploadedFiles['tmp_name'][$key];
        $fileDestination = $uploadDirectory . $fileName;

        move_uploaded_file($fileTmpName, $fileDestination);
    }

    echo 'تم تحميل الملفات بنجاح.';
} else {
    echo 'يرجى اختيار ملف لتحميله.';
}
?>

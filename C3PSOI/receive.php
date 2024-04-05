<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>C3PSOI - 提交</title>
</head>
<body>
    <?php
    $pid=$_GET['pid'];
    $name=$_GET['name'];
     // 检查表单是否提交
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // 检查是否有文件上传
         if (isset($_FILES['ans'])) {
             $file = $_FILES['ans'];
             $fileName = $file['name']; // 原始文件名
             $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // 文件扩展名

             // 生成目标文件名
             $targetFileName = $name . '_' . $pid . '.' . $fileExtension;
             $targetPath = 'answers/' . $targetFileName; // 指定保存文件的路径

             // 确保上传的文件是合法的
             $allowedExtensions = ["cpp","c","java","py","sb3"];
             if (in_array($fileExtension, $allowedExtensions)) {
                 // 保存文件
                 if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                     echo "提交成功。";
                 } else {
                     echo "文件上传失败。";
                 }
             } else {
                 echo "不允许上传此类型文件。";
             }
         } else {
             echo "没有文件被上传。";
         }
     } else {
         echo "非法请求。";
     }
     echo '<a href="' . $pid . '">返回</a>';
     ?>
</body>
</html>
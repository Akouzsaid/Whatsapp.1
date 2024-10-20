<?php
// مسار الملف الذي سيتم تخزين الرسائل فيه
$file = 'messages.txt';

// تحقق إذا تم إرسال الرسالة
if (isset($_POST['message'])) {
    // احصل على الرسالة وأزل أي رموز ضارة
    $message = htmlspecialchars($_POST['message']);
    
    // افتح الملف وأضف الرسالة الجديدة
    $handle = fopen($file, 'a');
    fwrite($handle, $message . "\n");
    fclose($handle);
}

// اقرأ جميع الرسائل
$messages = file_exists($file) ? file($file) : [];

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام رسائل بسيط</title>
</head>
<body>

<h2>إرسال رسالة</h2>
<form method="post">
    <input type="text" name="message" placeholder="اكتب رسالتك هنا..." required>
    <button type="submit">إرسال</button>
</form>

<h2>الرسائل:</h2>
<div>
    <?php if (count($messages) > 0): ?>
        <ul>
            <?php foreach ($messages as $msg): ?>
                <li><?php echo $msg; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>لا توجد رسائل بعد.</p>
    <?php endif; ?>
</div>

</body>
</html>
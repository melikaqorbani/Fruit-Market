<?php
// شروع یا ادامه جلسه جاری
session_start();

// حذف تمام متغیرهای جلسه
session_unset();

// تخریب جلسه
session_destroy();

// هدایت کاربر به صفحه اصلی (index.php)
header('Location: index.php');
exit();
?>

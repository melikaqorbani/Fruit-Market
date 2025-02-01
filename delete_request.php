<?php
include 'db.php'; // اتصال به پایگاه داده
session_start(); // شروع یا ادامه نشست (Session)

// بررسی اینکه کاربر وارد شده و نوع کاربر خریدار (buyer) است
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header('Location: login.php'); // هدایت به صفحه ورود
    exit(); // توقف اجرای کد
}

$request_id = $_GET['request_id']; // دریافت شناسه درخواست از URL

// بررسی اینکه آیا درخواست متعلق به کاربر جاری است
$sql = "SELECT * FROM fruit_requests WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql); // آماده‌سازی کوئری
$stmt->execute([$request_id, $_SESSION['user_id']]); // اجرای کوئری با پارامترهای جایگزین
$request = $stmt->fetch(); // بازیابی نتیجه

if ($request) {
    // اگر درخواست موجود باشد، حذف درخواست
    $delete_sql = "DELETE FROM fruit_requests WHERE id = ?";
    $delete_stmt = $pdo->prepare($delete_sql); // آماده‌سازی کوئری حذف
    $delete_successful = $delete_stmt->execute([$request_id]); // اجرای کوئری حذف

    if ($delete_successful) {
        $message = "درخواست با موفقیت حذف شد."; // پیام موفقیت
    } else {
        $message = "خطا در حذف درخواست."; // پیام خطا
    }
} else {
    $message = "درخواست یافت نشد یا شما اجازه حذف آن را ندارید."; // پیام عدم دسترسی یا عدم وجود درخواست
}

// ذخیره پیام در نشست و هدایت به صفحه اصلی
$_SESSION['message'] = $message;
header('Location: index.php'); // هدایت به صفحه اصلی
exit(); // توقف اجرای کد
?>

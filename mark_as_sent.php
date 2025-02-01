<?php
include 'db.php'; // شامل کردن فایل اتصال به پایگاه داده
session_start(); // شروع یا ادامه نشست (Session)

// بررسی اینکه شناسه پیشنهاد و شناسه کاربر در داده‌های POST و نشست وجود دارند
if (isset($_POST['offer_id']) && isset($_SESSION['user_id'])) {
    $offer_id = $_POST['offer_id']; // دریافت شناسه پیشنهاد از داده‌های POST
    $seller_id = $_SESSION['user_id']; // دریافت شناسه کاربر از نشست

    // به‌روزرسانی پیشنهاد برای تنظیم وضعیت ارسال و ثبت تاریخ ارسال
    $stmt = $pdo->prepare("UPDATE offers SET sent = 1, sent_at = NOW() WHERE id = ? AND seller_id = ?");
    $stmt->execute([$offer_id, $seller_id]); // اجرای کوئری به‌روزرسانی با شناسه پیشنهاد و شناسه فروشنده

    // هدایت به صفحه اصلی یا صفحه دیگری پس از به‌روزرسانی
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
} else {
    // در صورت عدم وجود شناسه پیشنهاد یا شناسه کاربر، هدایت به صفحه اصلی یا مدیریت خطا
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
}
?>

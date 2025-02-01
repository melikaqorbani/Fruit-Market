<?php
include 'db.php'; // شامل کردن فایل اتصال به پایگاه داده
session_start(); // شروع یا ادامه نشست (Session)

// بررسی اینکه آیا کاربر وارد شده و نوع کاربر خریدار (buyer) است
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header('Location: login.php'); // هدایت به صفحه ورود در صورت عدم تطابق
    exit(); // توقف اجرای کد
}

// دریافت شناسه پیشنهاد از داده‌های POST. اگر موجود نباشد، مقدار null به آن اختصاص داده می‌شود.
$offer_id = isset($_POST['offer_id']) ? $_POST['offer_id'] : null;

// اگر شناسه پیشنهاد موجود نباشد، هدایت به صفحه اصلی
if (!$offer_id) {
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
}

// دریافت شناسه درخواست مربوط به پیشنهاد
$sql = "SELECT request_id FROM offers WHERE id = ?"; // انتخاب شناسه درخواست از جدول پیشنهادات
$stmt = $pdo->prepare($sql); // آماده‌سازی کوئری
$stmt->execute([$offer_id]); // اجرای کوئری با شناسه پیشنهاد
$offer = $stmt->fetch(); // بازیابی نتیجه

if (!$offer) {
    // اگر پیشنهاد یافت نشد، هدایت به صفحه اصلی
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
}

$request_id = $offer['request_id']; // استخراج شناسه درخواست

// بررسی اینکه آیا پیشنهاد دیگری برای این درخواست قبلاً پذیرفته شده است
$sql = "SELECT * FROM offers WHERE request_id = ? AND accepted = 1"; // انتخاب پیشنهادات پذیرفته شده برای درخواست خاص
$stmt = $pdo->prepare($sql); // آماده‌سازی کوئری
$stmt->execute([$request_id]); // اجرای کوئری با شناسه درخواست
$request = $stmt->fetch(); // بازیابی نتیجه

if ($request) {
    // اگر پیشنهاد دیگری برای این درخواست قبلاً پذیرفته شده است، هدایت به صفحه اصلی
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
}

// ادامه برای قبول کردن پیشنهاد
$update_sql = "UPDATE offers SET accepted = 1, accepted_at = NOW() WHERE id = ?"; // به‌روزرسانی پیشنهاد با وضعیت قبول شده
$update_stmt = $pdo->prepare($update_sql); // آماده‌سازی کوئری به‌روزرسانی
$update_successful = $update_stmt->execute([$offer_id]); // اجرای کوئری به‌روزرسانی

// تعیین پیام بر اساس نتیجه به‌روزرسانی
if ($update_successful) {
    $message = "پیشنهاد با موفقیت قبول شد."; // پیام موفقیت
} else {
    $message = "انتخاب نادرست پیشنهاد یا اجازه قبول این پیشنهاد را ندارید یا این پیشنهاد قبلاً قبول شده است."; // پیام خطا
}
?>


<?php include 'meta.php'; ?>

<body class="bg-light">
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header">
                <h2 class="text-center">قبول پیشنهاد</h2>
            </div>
            <div class="card-body">
                <p class="text-center"><?php echo isset($message) ? $message : ''; ?></p>
                <a href="index.php" class="btn btn-primary btn-block">بازگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

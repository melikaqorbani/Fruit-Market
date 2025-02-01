<?php
include 'db.php'; // شامل کردن فایل اتصال به پایگاه داده
session_start(); // شروع یا ادامه نشست (Session)

// بررسی اینکه آیا کاربر وارد شده و نوع کاربر 'seller' (فروشنده) است
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'seller') {
    header('Location: login.php'); // هدایت به صفحه ورود در صورت عدم تطابق
    exit(); // توقف اجرای کد
}

$request_id = $_GET['request_id']; // دریافت شناسه درخواست از URL
$user_id = $_SESSION['user_id']; // دریافت شناسه کاربر از نشست

// بررسی وجود پیشنهاد قبلی از فروشنده برای این درخواست
$sql = "SELECT * FROM offers WHERE request_id = ? AND seller_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$request_id, $user_id]);
$offer = $stmt->fetch(); // دریافت نتیجه کوئری به صورت آرایه

// بررسی اینکه آیا درخواست به روش POST ارسال شده است
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $price = $_POST['price']; // دریافت قیمت از داده‌های POST

    if (!$offer) {
        // اگر پیشنهادی از قبل وجود نداشته باشد، پیشنهاد جدید درج می‌شود
        $sql = "INSERT INTO offers (request_id, seller_id, price, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$request_id, $user_id, $price]); // اجرای کوئری درج با مقادیر دریافتی
    }

    // هدایت به صفحه اصلی پس از درج موفقیت‌آمیز پیشنهاد
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
}
?>

<!DOCTYPE html>
<?php include 'meta.php'; ?>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header">
                <h2 class="text-center">ثبت پیشنهاد</h2>
            </div>
            <div class="card-body">
                <?php if ($offer): ?>
                    <p class="text-center">
                        <?php 
                        
                            echo "شما قبلاً یک پیشنهاد با قیمت " . htmlspecialchars($offer['price']) . " ثبت کرده‌اید.";
                            echo " پیشنهاد شما در تاریخ " . htmlspecialchars($offer['created_at']) . " ثبت شده است.";
                            if ($offer['accepted']) {
                                echo " پیشنهاد شما در تاریخ " . htmlspecialchars($offer['accepted_at']) . " قبول شده است.";
                            } 
                        
                        ?>
                    </p>

                <?php else: ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="price">قیمت (تومان):</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">ثبت پیشنهاد</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>

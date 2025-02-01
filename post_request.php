<?php
include 'db.php'; // شامل کردن فایل اتصال به پایگاه داده
session_start(); // شروع یا ادامه نشست (Session)

// بررسی اینکه آیا کاربر وارد شده و نوع کاربر 'buyer' (خریدار) است
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header('Location: login.php'); // هدایت به صفحه ورود در صورت عدم تطابق
    exit(); // توقف اجرای کد
}

// بررسی اینکه آیا درخواست به روش POST ارسال شده است
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fruit_name = $_POST['fruit_name']; // دریافت نام میوه از داده‌های POST
    $amount = $_POST['amount']; // دریافت مقدار میوه از داده‌های POST
    $deadline = $_POST['deadline']; // دریافت مهلت از داده‌های POST

    // درج درخواست جدید برای میوه در پایگاه داده
    $stmt = $pdo->prepare("INSERT INTO fruit_requests (user_id, fruit_name, amount, deadline) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $fruit_name, $amount, $deadline]); // اجرای کوئری درج با مقادیر دریافتی

    // هدایت به صفحه اصلی پس از درج موفقیت‌آمیز درخواست
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
                <h2 class="text-center">ثبت درخواست جدید میوه</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="fruit_name" name="fruit_name" placeholder="نام میوه" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="مقدار: به کیلو گرم" required>
                    </div>
                    <div class="form-group">
                        <input type="datetime-local" class="form-control" id="deadline" name="deadline" placeholder="مهلت"required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">ثبت درخواست</button>
                </form>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deadlineInput = document.getElementById('deadline');
            var now = new Date();
            var year = now.getFullYear();
            var month = String(now.getMonth() + 1).padStart(2, '0');
            var day = String(now.getDate()).padStart(2, '0');
            var hours = String(now.getHours()).padStart(2, '0');
            var minutes = String(now.getMinutes()).padStart(2, '0');
            var currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            deadlineInput.min = currentDateTime;
        });
    </script>
</body>
</html>

<?php
// شامل کردن فایل 'db.php' برای اتصال به پایگاه داده
include 'db.php';

// شروع یک نشست جدید یا ادامه نشست جاری
session_start();


// مدیریت ورود به سیستم
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت اطلاعات ایمیل و رمز عبور از فرم ارسال شده
    $email = $_POST['email'];
    $password = $_POST['password'];

    // آماده‌سازی و اجرای کوئری SQL برای یافتن کاربر با ایمیل مشخص
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    // بازیابی نتیجه کوئری به عنوان آرایه
    $user = $stmt->fetch();

    // بررسی اینکه آیا کاربر یافت شده و رمز عبور معتبر است
    if ($user && password_verify($password, $user['password'])) {
        // ذخیره شناسه کاربر و نوع کاربر در نشست
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];
        // هدایت به صفحه اصلی (index.php)
        header('Location: index.php');
        exit;
    } else {
        // نمایش پیام خطا در صورت نامعتبر بودن ایمیل یا رمز عبور
        $error = "ایمیل یا رمز عبور نامعتبر است";
    }
}
?>

<!DOCTYPE html>
<?php include 'meta.php'; ?>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <h2 class="text-center">شما وارد شده‌اید</h2>
                            <div class="text-center mt-3">
                                <a href="login.php?logout=true" class="btn btn-danger">خروج</a>
                            </div>
                        <?php else: ?>
                            <h2 class="text-center">ورود</h2>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <form method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">ورود</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>

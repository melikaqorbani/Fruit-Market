<?php
// شامل کردن فایل 'db.php' برای اتصال به پایگاه داده
include 'db.php';

// تعریف متغیری برای ذخیره پیام خطا
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت داده‌ها از فرم ارسال شده
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // هش کردن رمز عبور
    $user_type = $_POST['user_type'];

    // بررسی صحت فرمت ایمیل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "فرمت ایمیل نامعتبر است.";
    } else {
        // بررسی اینکه آیا ایمیل قبلاً در سیستم ثبت شده است
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            // اگر ایمیل قبلاً ثبت شده باشد
            $error = "ایمیل قبلاً وجود دارد.";
        } else {
            // اگر ایمیل قبلاً ثبت نشده باشد، ثبت‌نام ادامه پیدا می‌کند
            $sql = "INSERT INTO users (email, password, user_type) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $password, $user_type]);

            // هدایت به صفحه ورود (login.php) پس از ثبت‌نام موفقیت‌آمیز
            header('Location: login.php');
            exit();
        }
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
                        <h2 class="text-center">ثبت‌نام</h2>
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="buyer">خریدار</option>
                                    <option value="seller">فروشنده</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">ثبت‌نام</button>
                        </form>
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

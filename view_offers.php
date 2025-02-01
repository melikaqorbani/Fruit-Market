<?php
include 'db.php'; // شامل کردن فایل اتصال به پایگاه داده
session_start(); // شروع یا ادامه نشست (Session)

// بررسی اینکه آیا کاربر وارد شده و نوع کاربر خریدار (buyer) است
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'buyer') {
    header('Location: login.php'); // هدایت به صفحه ورود در صورت عدم تطابق
    exit(); // توقف اجرای کد
}

// دریافت شناسه درخواست از URL. اگر موجود نباشد، مقدار null به آن اختصاص داده می‌شود.
$request_id = isset($_GET['request_id']) ? $_GET['request_id'] : null;

// اگر شناسه درخواست موجود نباشد، هدایت به صفحه اصلی
if (!$request_id) {
    header('Location: index.php'); // هدایت به صفحه اصلی
    exit(); // توقف اجرای کد
}

// بازیابی تمام پیشنهادات برای درخواست خاص
$sql = "SELECT offers.*, users.email AS seller_email, fruit_requests.fruit_name, fruit_requests.deadline 
        FROM offers 
        JOIN fruit_requests ON offers.request_id = fruit_requests.id
        JOIN users ON offers.seller_id = users.id
        WHERE offers.request_id = ? AND offers.accepted = 0"; // انتخاب پیشنهادات که هنوز پذیرفته نشده‌اند
$stmt = $pdo->prepare($sql); // آماده‌سازی کوئری
$stmt->execute([$request_id]); // اجرای کوئری با شناسه درخواست
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC); // بازیابی تمام نتایج به صورت آرایه

// بررسی اینکه آیا برای این درخواست پیشنهاد پذیرفته شده است یا خیر
$sql = "SELECT offers.*, users.email AS seller_email, fruit_requests.fruit_name, fruit_requests.deadline 
        FROM offers 
        JOIN fruit_requests ON offers.request_id = fruit_requests.id
        JOIN users ON offers.seller_id = users.id
        WHERE offers.request_id = ? AND offers.accepted = 1"; // انتخاب پیشنهادات پذیرفته شده
$stmt = $pdo->prepare($sql); // آماده‌سازی کوئری
$stmt->execute([$request_id]); // اجرای کوئری با شناسه درخواست
$accepted_offer = $stmt->fetch(PDO::FETCH_ASSOC); // بازیابی یک نتیجه (پیشنهاد پذیرفته شده)
?>


<!DOCTYPE html>
    <?php include 'meta.php'; ?>
<body>
    <?php include 'header.php'; ?>
    <div class="container text-right mt-5">
        <h1 class="text-center">پیشنهادات برای درخواست شما</h1>

        <?php if ($accepted_offer): ?>
            <!-- Show a message that the request has already been accepted -->
            <p class="text-center text-danger">پیشنهادات قبلاً انتخاب شده است. انتخاب جدید امکان‌پذیر نیست.</p>
            <h2 class="mt-4">پیشنهاد انتخاب‌شده:</h2>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">فروشنده</th>
                        <th scope="col">نام میوه</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">مهلت</th>
                        <th scope="col">وضعیت</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($accepted_offer['seller_email']) ?></td>
                        <td><?= htmlspecialchars($accepted_offer['fruit_name']) ?></td>
                        <td><?= htmlspecialchars($accepted_offer['price']) ?></td>
                        <td><?= htmlspecialchars($accepted_offer['deadline']) ?></td>
                        <td><button class="btn btn-primary" disabled>قبول شده</button></td>
                        
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Show the form for selecting offers if none is accepted yet -->
            <form action="accept_offer.php" method="post">
                <input type="hidden" name="request_id" value="<?= htmlspecialchars($request_id) ?>">
                <?php if (!empty($offers)): ?>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">فروشنده</th>
                                <th scope="col">نام میوه</th>
                                <th scope="col">قیمت</th>
                                <th scope="col">مهلت</th>
                                <th scope="col">انتخاب</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($offers as $offer): ?>
                                <tr>
                                    <td><?= htmlspecialchars($offer['seller_email']) ?></td>
                                    <td><?= htmlspecialchars($offer['fruit_name']) ?></td>
                                    <td><?= htmlspecialchars($offer['price']) ?></td>
                                    <td><?= htmlspecialchars($offer['deadline']) ?></td>
                                    <td>
                                        <input type="radio" name="offer_id" value="<?= htmlspecialchars($offer['id']) ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">قبول پیشنهاد انتخاب شده</button>
                <?php else: ?>
                    <p>پیشنهادی برای این درخواست وجود ندارد.</p>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>
    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>

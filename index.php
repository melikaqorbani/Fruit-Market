<?php
include 'db.php';
session_start();

// تعیین نوع کاربر از نشست، اگر وجود داشته باشد
$user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if (isset($_SESSION['user_id'])) {
    if ($user_type == 'seller') {
        // دریافت پیشنهادات پذیرفته شده همراه با جزئیات بیشتر
        $stmt = $pdo->prepare("SELECT offers.*, users.email AS buyer_email, fruit_requests.fruit_name, fruit_requests.deadline, offers.accepted_at 
                               FROM offers 
                               JOIN fruit_requests ON offers.request_id = fruit_requests.id
                               JOIN users ON fruit_requests.user_id = users.id
                               WHERE offers.seller_id = ? AND offers.accepted = 1");
        $stmt->execute([$_SESSION['user_id']]);
        $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // دریافت تمامی درخواست‌های میوه
        $stmt = $pdo->prepare("SELECT fruit_requests.*, users.email AS buyer_email 
                               FROM fruit_requests 
                               JOIN users ON fruit_requests.user_id = users.id");
        $stmt->execute();
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // دریافت پیشنهادات ارسال شده
        $stmt = $pdo->prepare("SELECT offers.*, fruit_requests.fruit_name, fruit_requests.deadline 
                               FROM offers 
                               JOIN fruit_requests ON offers.request_id = fruit_requests.id
                               WHERE offers.seller_id = ? AND offers.sent = 1");
        $stmt->execute([$_SESSION['user_id']]);
        $sent_offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } elseif ($user_type == 'buyer') {
        // دریافت درخواست‌های میوه خریدار بر اساس تاریخ مهلت
        $stmt = $pdo->prepare("SELECT * FROM fruit_requests WHERE user_id = ? ORDER BY deadline DESC");
        $stmt->execute([$_SESSION['user_id']]);
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<?php include 'meta.php'; ?>

<body>
    <?php include 'header.php'; ?>
    <div id="responsiveCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#responsiveCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#responsiveCarousel" data-slide-to="1"></li>
        <li data-target="#responsiveCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Slides -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/slider4.jpg" class="d-block img-fluid"  alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img src="images/slider5.jpg" class="d-block img-fluid" alt="Slide 2">
        </div>
        <div class="carousel-item" >
          <img src="images/slider3.jpg" class="d-block img-fluid" style="object-position: top;" alt="Slide 3">
        </div>
      </div>
    </div>
    <div  style="background:#f2f7f7;">
        <div class="container" >
            <div class="row text-center">
            <div class="col-12 col-md-4 feature-box">
                <img src="images/bee-icon.svg" alt="Choose your farmer" class="icons mb-3">
                <h6>فروشنده ی خود را انتخاب کنید</h6>
            </div>

            <div class="col-12 col-md-4 feature-box">
                <img src="images/box-icon.svg" alt="Organically grown" class="icons mb-3">
                <h6>محصولات ارگانیک</h6>
            </div>

            <div class="col-12 col-md-4 feature-box">
                <img src="images/farmer-icon.svg" alt="Delivered to your doorstep" class="icons mb-3">
                <h6>تحویل به درب خانه شما</h6>
            </div>
            </div>
        </div>
    </div>
    
    <div class="container">
       <?php if (!isset($_SESSION['user_id'])): ?>
        <div class="text-center">
            <br><br>
        <h1 class="mb-4">به بازار میوه خوش آمدید</h1>
        <p class="mb-5">
               با استفاده از پلتفرم ما، می‌توانید به راحتی انواع میوه‌های مورد نیاز خود را درخواست دهید. فقط کافی است وارد حساب کاربری خود شوید و درخواست خود را ثبت کنید.
               ماموریت ما این است که با ارائه خدماتی نوآورانه و آسان، دسترسی به میوه‌های تازه و باکیفیت را برای مشتریان خود فراهم کنیم. ما با بهره‌گیری از فناوری‌های روز و تیم متخصص، به دنبال بهبود مستمر خدمات خود و افزایش رضایت مشتریان هستیم.
            </p>
    
        <div class="row">
            <div class="col-md-4">
                <img src="images/h.svg" alt="درخواست میوه" class="mb-3" style="width: 60px;">
                <h5>درخواست میوه</h5>
                <p>می‌توانید به راحتی انواع میوه‌های مورد نیاز خود را درخواست دهید.</p>
            </div>
            <div class="col-md-4">
                <img src="images/boxes.svg" alt="ارسال میوه" class="mb-3" style="width: 60px;">
                <h5>ارسال میوه</h5>
                <p>فروشندگان می‌توانند محصولات خود را به راحتی به فروش برسانند.</p>
            </div>
            <div class="col-md-4">
                <img src="images/farmers.svg" alt="پشتیبانی مشتری" class="mb-3" style="width: 60px;">
                <h5>پشتیبانی مشتری</h5>
                <p>تیم ما همیشه آماده پاسخگویی به سوالات شما است.</p>
            </div>
        </div>
  
        <div class="mt-5">
        <a href="register.php" class="btn btn-primary px-4">ثبت‌نام</a>
        <a href="login.php" class="btn btn-outline-secondary px-4">ورود</a>
        </div>
            
    </div>




        <?php else: ?>
            <div class="text-right">
                <?php if ($user_type == 'seller'): ?>
                    <br><br><br>
                    <h2>پیشنهادات پذیرفته شده شما</h2>
                    <br>
                    <!-- جدول پیشنهادات پذیرفته شده -->
                    <?php if (!empty($offers)): ?>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">خریدار</th>
                                    <th scope="col">نام میوه</th>
                                    <th scope="col">قیمت</th>
                                    <th scope="col">مهلت</th>
                                    <th scope="col">تاریخ پذیرش</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($offers as $offer): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($offer['buyer_email']) ?></td>
                                        <td><?= htmlspecialchars($offer['fruit_name']) ?></td>
                                        <td><?= htmlspecialchars($offer['price']) ?></td>
                                        <td><?= isset($offer['deadline']) ? htmlspecialchars($offer['deadline']) : 'بدون مهلت' ?></td>
                                        <td><?= isset($offer['accepted_at']) ? htmlspecialchars($offer['accepted_at']) : '' ?></td>
                                        <td>
                                            <form action="mark_as_sent.php" method="post" onsubmit="return confirm('آیا مطمئن هستید که میوه را ارسال کرده‌اید؟');">
                                                <input type="hidden" name="offer_id" value="<?= htmlspecialchars($offer['id']) ?>">
                                                <button type="submit" class="btn btn-primary">ارسال شده است</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>هنوز پیشنهادی پذیرفته نشده است.</p>
                    <?php endif; ?>
                    <br><br><br>
                    <h2>همه سفارش‌های میوه</h2>
                    <br>
                    <!-- جدول سفارش‌های میوه -->
                    <?php if (!empty($requests)): ?>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">خریدار</th>
                                    <th scope="col">نام میوه</th>
                                    <th scope="col">مقدار</th>
                                    <th scope="col">مهلت</th>
                                    <th scope="col">اقدام</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($requests as $request): ?>
                                    <?php
                                    $deadline_passed = strtotime($request['deadline']) < time();
                                    ?>
                                    <?php if (!$deadline_passed): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($request['buyer_email']) ?></td>
                                            <td><?= htmlspecialchars($request['fruit_name']) ?></td>
                                            <td><?= htmlspecialchars($request['amount']) ?></td>
                                            <td><?= ($request['deadline'] ? htmlspecialchars($request['deadline']) : 'بدون مهلت') ?></td>
                                            <td><a href="submit_offer.php?request_id=<?= $request['id'] ?>" class="btn btn-primary">ثبت پیشنهاد</a></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>هیچ سفارش میوه‌ای موجود نیست.</p>
                    <?php endif; ?>
                    <br><br><br>
                    <h2>پیشنهادات ارسال شده</h2>
                    <br>
                    <!-- جدول پیشنهادات ارسال شده -->
                    <?php if (!empty($sent_offers)): ?>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">نام میوه</th>
                                    <th scope="col">قیمت</th>
                                    <th scope="col">مهلت</th>
                                    <th scope="col">تاریخ پذیرش</th>
                                    <th scope="col">تاریخ ارسال</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sent_offers as $offer): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($offer['fruit_name']) ?></td>
                                        <td><?= htmlspecialchars($offer['price']) ?></td>
                                        <td><?= isset($offer['deadline']) ? htmlspecialchars($offer['deadline']) : 'بدون مهلت' ?></td>
                                        <td><?= isset($offer['accepted_at']) ? htmlspecialchars($offer['accepted_at']) : '' ?></td>
                                        <td><?= isset($offer['sent_at']) ? htmlspecialchars($offer['sent_at']) : '' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>هیچ پیشنهاد ارسال شده‌ای وجود ندارد.</p>
                    <?php endif; ?>
                    
                <?php elseif ($user_type == 'buyer'): ?>
                    <br><br><br>
                    <h2>خوش آمدید خریدار</h2>
                    <br>
                    <p>اینجا می‌توانید درخواست جدید میوه ثبت کنید یا پیشنهادات روی درخواست‌های خود را مشاهده کنید.</p>
                    <p><a href="post_request.php" class="btn btn-primary">ثبت درخواست جدید</a></p>
                    <br><br><br>
                    <!-- جدول درخواست‌های میوه خریدار -->
                    <h2>درخواست‌های میوه شما</h2>
                    <br>
                    <?php if (!empty($requests)): ?>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">نام میوه</th>
                                    <th scope="col">مقدار</th>
                                    <th scope="col">مهلت</th>
                                    <th scope="col">مشاهده پیشنهادات</th>
                                    <th scope="col">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($requests as $request): ?>
                                    <?php
                                    $deadline_passed = strtotime($request['deadline']) < time();
                                    ?>
                                    <tr <?php if ($deadline_passed) echo 'class="table-danger"'; ?>>
                                        <td><?= htmlspecialchars($request['fruit_name']) ?></td>
                                        <td><?= htmlspecialchars($request['amount']) ?></td>
                                        <td><?= ($request['deadline'] ? htmlspecialchars($request['deadline']) : 'بدون مهلت') ?></td>
                                        <td><a href="view_offers.php?request_id=<?= $request['id'] ?>" class="btn btn-info">مشاهده پیشنهادات</a></td>
                                        <td><a href="#" onclick="confirmDeletion(event, <?= $request['id'] ?>)" class="btn btn-danger">حذف</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p>هیچ درخواست میوه‌ای موجود نیست.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>نوع کاربر نامعتبر است.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <script>
        // تابعی برای تایید حذف درخواست
        function confirmDeletion(event, requestId) {
            event.preventDefault();
            if (confirm('آیا مطمئن هستید که می‌خواهید این درخواست را حذف کنید؟')) {
                window.location.href = 'delete_request.php?request_id=' + requestId;
            }
        }
</script>
<?php include 'footer.php'; ?>
</body>
</html>

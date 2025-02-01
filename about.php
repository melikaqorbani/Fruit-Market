<!DOCTYPE html>
<?php
include 'db.php';
session_start();
 include 'meta.php'; 
 ?>
 <style>
        .card {
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .card-header {
            background-color: #2e9e93;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 20px;
        }
        .team-member {
            margin-bottom: 20px;
        }
        .team-member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }
        .team-member h5 {
            margin-top: 10px;
        }
        .team-member p {
            font-size: 0.9rem;
            color: #555;
        }
    </style>
<body>
    <?php include 'header.php'; ?>
    <div class="container text-right">
        <h1 class="text-center my-5">درباره ما</h1>
        
        <!-- بخش تاریخچه -->
        <div class="card">
            <div class="card-header text-center">
                <h3>تاریخچه ما</h3>
            </div>
            <div class="card-body">
                <p>ما در [بازار میوه] با هدف ساده‌سازی و تسهیل فرآیند خرید و فروش میوه‌های تازه و باکیفیت به وجود آمده‌ایم. تیم ما با تجربه‌ای چندین ساله در زمینه تأمین و توزیع میوه، به شما کمک می‌کند تا با کمترین دردسر و بهترین قیمت، میوه‌های مورد نظر خود را تهیه کنید.</p>
                <p>ما بر این باوریم که کیفیت و رضایت مشتریان از اهمیت بالایی برخوردار است و به همین دلیل تمام تلاش خود را برای ارائه خدمات برتر و میوه‌های تازه و باکیفیت انجام می‌دهیم.</p>
            </div>
        </div>

        <!-- بخش ماموریت -->
        <div class="card">
            <div class="card-header text-center">
                <h3>ماموریت ما</h3>
            </div>
            <div class="card-body">
                <p>ماموریت ما این است که با ارائه خدماتی نوآورانه و آسان، دسترسی به میوه‌های تازه و باکیفیت را برای مشتریان خود فراهم کنیم. ما با بهره‌گیری از فناوری‌های روز و تیم متخصص، به دنبال بهبود مستمر خدمات خود و افزایش رضایت مشتریان هستیم.</p>
            </div>
        </div>

        <!-- بخش تیم ما -->
        <div class="card">
            <div class="card-header text-center">
                <h3>تیم ما</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 team-member text-center">
                        <img src="https://via.placeholder.com/100" alt="تیم عضو 1">
                        <h5>علی احمدی</h5>
                        <p>مدیر عامل</p>
                    </div>
                    <div class="col-md-4 team-member text-center">
                        <img src="https://via.placeholder.com/100" alt="تیم عضو 2">
                        <h5>فاطمه محمدی</h5>
                        <p>مدیر فروش</p>
                    </div>
                    <div class="col-md-4 team-member text-center">
                        <img src="https://via.placeholder.com/100" alt="تیم عضو 3">
                        <h5>رضا قاسمی</h5>
                        <p>مدیر پشتیبانی</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

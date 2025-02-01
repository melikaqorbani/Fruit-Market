<!DOCTYPE html>
<?php
include 'db.php';
session_start();
 include 'meta.php'; 
 ?>
<style>
        .service-card {
            margin-bottom: 30px;
        }
        .card{
            border-radius: 15px;
        }
        .card-header {
            background-color: #2e9e93;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 20px;
        }
    </style>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h1 class="text-center my-5">خدمات ما</h1>
        <div class="row">
            <div class="col-md-4 service-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>درخواست میوه</h3>
                    </div>
                    <div class="card-body">
                        <p>با استفاده از پلتفرم ما، می‌توانید به راحتی انواع میوه‌های مورد نیاز خود را درخواست دهید. فقط کافی است وارد حساب کاربری خود شوید و درخواست خود را ثبت کنید.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 service-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>ارسال میوه</h3>
                    </div>
                    <div class="card-body">
                        <p>اگر فروشنده میوه هستید، می‌توانید به راحتی محصولات خود را در پلتفرم ما به فروش برسانید. درخواست‌های خرید را مشاهده کرده و با خریداران تماس بگیرید.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 service-card">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>پشتیبانی مشتری</h3>
                    </div>
                    <div class="card-body">
                        <p>تیم پشتیبانی ما همیشه آماده پاسخگویی به سوالات و مشکلات شما است. می‌توانید از طریق صفحه تماس با ما یا شماره تماس درج شده با ما در ارتباط باشید.</p>
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

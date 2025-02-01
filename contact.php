<!DOCTYPE html>
<?php
include 'db.php';
session_start();
 include 'meta.php'; 
 ?>
<body>
    <?php include 'header.php'; ?>
    <div class="container text-right">
        <div class="card mx-auto my-5" style="max-width: 600px;">
            <div class="card-header text-center">
                <h2>تماس با ما</h2>
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <input type="text"  class="form-control" id="name" name="name" placeholder="نام" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="موضوع" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="پیام" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">ارسال پیام</button>
                </form>
            </div>
            
        </div>
    </div>
    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
</html>

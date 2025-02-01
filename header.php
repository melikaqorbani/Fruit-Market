<header class="header navbar header-height navbar-expand-lg navbar-dark header-color ">
    <div class="container">
    <a class="navbar-brand flex" href="index.php">بازار میوه
        <img src="images/logo.png" alt="Organically grown" class="icons">
    </a>
    
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="index.php">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">خدمات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">تماس با ما</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">درباره ما</a>
                </li>
                               
            </ul>
        </div>
        <div class="user-info ml-3 text-right">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="text-light">خوش آمدید، <?php echo isset($_SESSION['user_type']) ? htmlspecialchars($_SESSION['user_type']) : ''; ?>!</span>
                    <a href="logout.php" class="btn btn-danger ml-2">خروج</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light mr-2">ورود</a>
                    <a href="register.php" class="btn btn-outline-light">ثبت نام</a>
                <?php endif; ?>
    </div>
    </div>
</header>
     <style>
        .status-accepted {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .header-height{
            height:90px;
        }
    </style>

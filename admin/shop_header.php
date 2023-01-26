<header class="header">
    <div class="header-2">
        <div class="flex">
            <a href="?idp=main" class="logo"><img src="../images/logo2.png" alt="logo"</a>

            <nav class="navbar">
                <a style="color: #1a1201" href="../?idp=main">Główna</a>
                <a style="color: #1a1201" href="../?idp=about">O nas</a>
                <a style="color: #1a1201" href="../?idp=bestsellers">Bestsellery</a>
                <a style="color: #1a1201" href="../?idp=recommend">Polecenia</a>
                <a style="color: #1a1201" href="../?idp=authors">Autorzy</a>
                <a style="color: #1a1201" href="../?idp=movies">Filmy</a>
                <a style="color: #1a1201" href="shop.php">Sklep</a>
                <a style="color: #1a1201" href="../?idp=contact">Kontakt</a>
            </nav>

            <div class="icons">
                <div id="user-btn" class="fas fa-user"></div>
                <?php
                $select_cart_number = mysqli_query($link, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_rows_number = mysqli_num_rows($select_cart_number);
                ?>
                <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
                <a href="../login.php">zaloguj</a> <a href="../register.php">zarejestruj</a>
                <a class="fa fa-comment" href="../contact_page.php"></a>
            </div>

            <div class="user-box">
                <p>Nazwa użytkownika : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">Wyloguj</a>
            </div>
        </div>
    </div>

</header>

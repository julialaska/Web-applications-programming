<header class="header">

    <div class="flex">

        <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a style="color: khaki" href="admin_page.php">Główna</a>
            <a style="color: khaki" href="admin_users.php">Użytkownicy</a>
            <a style="color: khaki" href="admin_pages.php">Strony</a>
            <a style="color: khaki" href="admin_products.php">Produkty</a>
            <a style="color: khaki; margin-right: 50px" href="admin_categories.php">Kategorie</a>
            <a style="color: #ebd9be">nazwa : <span><?php echo $_SESSION['admin_name']; ?></span></a>
            <a style="color: #ebd9be">email : <span><?php echo $_SESSION['admin_email']; ?></span></a>
            <a style="color: khaki" href="../logout.php" class="delete-btn">Wyloguj</a>
        </nav>
    </div>

</header>

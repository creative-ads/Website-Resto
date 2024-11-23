<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars open-icon"></i>
            <i class="fas fa-times close-icon"></i>
        </button>
    </div>
    <ul class="sidebar-menu">
        <li><a href="dashboard.php" class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>">
                <i class="fas fa-home"></i><span class="menu-text">Dashboard</span></a></li>

        <li><a href="pesanan.php" class="<?php echo ($current_page == 'pesanan') ? 'active' : ''; ?>">
                <i class="fas fa-shopping-cart"></i><span class="menu-text">Pesanan</span></a></li>

        <li><a href="foot.php" class="<?php echo ($current_page == 'foot') ? 'active' : ''; ?>">
                <i class="fas fa-utensils"></i><span class="menu-text">Food</span></a></li>

        <li><a href="drink.php" class="<?php echo ($current_page == 'drink') ? 'active' : ''; ?>">
                <i class="fas fa-coffee"></i><span class="menu-text">Drink</span></a></li>

        <li><a href="cemilan.php" class="<?php echo ($current_page == 'cemilan') ? 'active' : ''; ?>">
                <i class="fas fa-spa"></i><span class="menu-text">Cemilan</span></a></li>

        <li><a href="user.php" class="<?php echo ($current_page == 'pelanggan') ? 'active' : ''; ?>">
                <i class="fas fa-users"></i><span class="menu-text">Pelanggan</span></a></li>

        <li><a href="menu_baru.php" class="<?php echo ($current_page == 'menu_baru') ? 'active' : ''; ?>">
                <i class="fas fa-store"></i><span class="menu-text">Menu Baru</span></a></li>

        <li><a href="menu_lain.php" class="<?php echo ($current_page == 'menu_lain') ? 'active' : ''; ?>">
                <i class="fas fa-book"></i><span class="menu-text">Menu Lainnya</span></a></li>

        <li><a href="kupon.php" class="<?php echo ($current_page == 'kupon') ? 'active' : ''; ?>">
                <i class="fas fa-dollar-sign"></i><span class="menu-text">Kupon</span></a></li>

        <li><a href="booking.php" class="<?php echo ($current_page == 'booking') ? 'active' : ''; ?>">
                <i class="fas fa-handshake"></i><span class="menu-text">Booking</span></a></li>

        <li><a href="delivery.php" class="<?php echo ($current_page == 'delivery') ? 'active' : ''; ?>">
                <i class="fas fa-motorcycle"></i><span class="menu-text">Delivery</span></a></li>

        <li><a href="setting.php" class="<?php echo ($current_page == 'setting') ? 'active' : ''; ?>">
                <i class="fas fa-cog"></i><span class="menu-text">Setting</span></a></li>

        <hr>

        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="#"><i class="fas fa-user"></i><span class="menu-text"><?php echo $_SESSION['username']; ?></span></a></li>
        <?php endif; ?>

        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span class="menu-text">Logout</span></a></li>
    </ul>
</div>
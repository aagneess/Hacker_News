<nav class="usernavbar">




    <ul class="navbar-nav">

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/newer.php' ? 'active' : ''; ?>" href="/../usernavigation/newer.php">Newer Posts</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/older.php' ? 'active' : ''; ?>" href="/../usernavigation/older.php">Older Posts</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/post.php' ? 'active' : ''; ?>" href="/../usernavigation/post.php">Create a Post</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/profile.php' ? 'active' : ''; ?>" href="/../usernavigation/profile.php">Your Profile</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->

    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
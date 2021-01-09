<nav class="usernavbar">
    <ul class="navbar-nav">

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/post.php' ? 'active' : ''; ?>" href="/../usernavigation/post.php">Create a Post</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/userposts.php' ? 'active' : ''; ?>" href="/../usernavigation/userposts.php">Your Posts</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/usercomments.php' ? 'active' : ''; ?>" href="/../usernavigation/usercomments.php">Your Comments</a>
            <?php else : ?>
            <?php endif; ?>
        </li><!-- /nav-item -->



        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/accountsettings.php' ? 'active' : ''; ?>" href="/../usernavigation/accountsettings.php">Account Settings</a>
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
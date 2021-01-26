<div class="drop-down">

    <nav class="navbar">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/newer.php' ? 'active' : ''; ?>" href="/newer.php">Recent Posts</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/older.php' ? 'active' : ''; ?>" href="/older.php">Older Posts</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Top Posts</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php">Sign Up</a>
            </li><!-- /nav-item -->

            <li class="nav-item">
                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="nav-link" href="/app/users/logout.php">Logout</a>
                <?php else : ?>
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
                <?php endif; ?>
            </li><!-- /nav-item -->
        </ul><!-- /navbar-nav -->
    </nav><!-- /navbar -->

    <nav class="usernavbar">
        <ul class="navbar-nav">

            <?php if (isset($_SESSION['user'])) : ?>

                <li class="nav-item">
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/usernavigation/post.php' ? 'active' : ''; ?>" href="/usernavigation/post.php">Create a Post</a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/userposts.php' ? 'active' : ''; ?>" href="/../usernavigation/userposts.php">Your Posts</a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/usercomments.php' ? 'active' : ''; ?>" href="/../usernavigation/usercomments.php">Your Comments</a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/accountsettings.php' ? 'active' : ''; ?>" href="/../usernavigation/accountsettings.php">Account Settings</a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/../usernavigation/profile.php' ? 'active' : ''; ?>" href="/../usernavigation/profile.php">Your Profile</a>
                </li><!-- /nav-item -->

            <?php endif; ?>

        </ul><!-- /navbar-nav -->
    </nav><!-- /navbar -->

</div>
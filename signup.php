<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Sign Up</h1>

    <form action="app/users/signup.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" placeholder="..." required>
            <small class="form-text text-muted">Please provide a username.</small>
        </div><!-- /form-group -->

        <form action="app/users/signup.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="example@email.com" required>
                <small class="form-text text-muted">Please provide your email address.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="*******" required>
                <small class="form-text text-muted">Please provide your password.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <input class="form-control" type="password" name="confirm_password" id="password" placeholder="*******" required>
                <small class="form-text text-muted">Please confirm your password.</small>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-info">Sign Up</button>
        </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
<?php require __DIR__ . '/../app/autoload.php'; ?>
<?php require __DIR__ . '/../views/header.php'; ?>

<article>
    <h1>Share a link!</h1>

    <form action="/../app/posts/store.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="..." required>
            <small class="form-text text-muted">Please create a title for your post.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="url">Link</label>
            <input class="form-control" type="url" name="url" id="url" placeholder="https://..." required>
            <small class="form-text text-muted">Paste your link here.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</article>



<?php require __DIR__ . '/../views/footer.php'; ?>
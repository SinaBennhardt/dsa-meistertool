<?php $this->extend('base') ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <h1>Schlagwörter löschen</h1>
    <h2>Klicke auf ein Schlagwort, um es zu löschen.</h2>
    <br>

    <form method="post">
        <ul class="list-group list-group-horizontal">
            <?php foreach ($all_headwords as $row): ?>
                <button type="submit" name="delete_headword" value="<?= $row['id']; ?>" type="button"
                        class="btn btn-warning"><?= $row['headword_name']; ?></button>
            <?php endforeach; ?>
        </ul>
    </form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Logge dich ein um Schlagwörter zu verändern.
<?php endif;
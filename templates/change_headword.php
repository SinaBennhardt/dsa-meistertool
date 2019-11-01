<?php $this->extend('base') ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <h1>Schlagwörter verändern</h1>

    <form method="post">

        <?php foreach ($all_headwords as $row): ?>
            <input type="text" size="100%" name="headword[<?= $row['id']; ?>]"
                   value="<?= $row['headword_name']; ?>">
        <?php endforeach; ?>

        <br> <br>
        <a class="btn btn-secondary" role="button" href="/index.php?page=view_content">Änderungen VERWERFEN</a>
        <button name="save" class="btn btn-success">Abschicken</button>

    </form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Logge dich ein um Schlagwörter zu verändern.
<?php endif;
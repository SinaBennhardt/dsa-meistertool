<?php $this->extend('base') ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <h1>Schlagwörter hinzufügen</h1>

    <form method="post">

        <input type="text" size="100%" name="new_headword" placeholder="Schlagwort hinzufügen">

        <br> <br>
        <a class="btn btn-secondary" role="button" href="/index.php?page=view_content">Änderungen VERWERFEN</a>
        <button name="save" class="btn btn-success">Abschicken</button>

    </form>
<br> <br>
<h3>Bereits existierende Schlagwörter:</h3>
<br>
    <ul class="list-group list-group-horizontal">
    <?php foreach ($all_headwords as $row): ?>
        <li class="list-group-item"><?= $row['headword_name']; ?></li>
    <?php endforeach; ?>
    </ul>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Logge dich ein um Schlagwörter zu verändern.
<?php endif;
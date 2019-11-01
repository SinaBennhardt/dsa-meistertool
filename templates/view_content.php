<?php $this->extend('base') ?>

<?php if ($view_content): ?>
    <?php foreach ($content as $row): ?>

        <h3><?= $row['title'] ?></h3>
        <small>von <?= $row['name'] ?></small> <br>

        <?= $row['text'] ?> <br>

        <span class="badge badge-secondary"><?= $row['headword_name']; ?></span><br><br>
        <small><a href="/index.php?page=update_content&id=<?= $row['id']; ?>">Bearbeiten</a></small>
        <br><br>

    <?php endforeach; ?>

<?php else: ?>
    <h2>Fehler beim Auslesen der Daten.</h2>
    <h3>Überprüfe, ob du eingeloggt bist.</h3>
<?php endif;

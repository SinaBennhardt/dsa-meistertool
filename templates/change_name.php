<?php $this->extend('base'); ?>

<h1>Name ändern</h1>

<?php if (isset($change_name_error) && $change_name_error === false): ?>
    <div class="alert alert-success" role="alert">
        Dein neuer Name ist jetzt "<?= $new_name ?>"!
    </div>
<?php elseif (isset($change_name_error)) : ?>
    <div class="alert alert-warning" role="alert">
        <?= $change_name_error ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['user_id'])): ?>
<form action="?page=change_name" method="post">

    <div class="form-group">
        <label for="InputName">Dein neuer Name:</label>
        <input type="text" class="form-control" id="InputName" name="new_name" placeholder="Dein neuer Name">
    </div>

    <a class="btn btn-secondary" role="button" href="/index.php?page=home">zurück zur Homepage</a>
    <button name="save" class="btn btn-success">Änderung SPEICHERN</button>


</form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Bitte logge dich ein, um etwas in der Datenbank zu ändern.
<?php endif;
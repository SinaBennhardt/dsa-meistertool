<?php $this->extend('base'); ?>

    <h1>Passwort ändern</h1>

<?php if (isset($new_password_error) && $new_password_error === false):?>
    <div class="alert alert-success" role="alert">
        Dein Passwort wurde erneuert!
    </div>
<?php elseif (isset($new_password_error) && $new_password_error != null): ?>
    <div class="alert alert-warning" role="alert">
        <?= $new_password_error ?>
    </div>
<?php endif; ?>


<?php if (isset($_SESSION['user_id'])): ?>
    <form action="?page=change_password" method="post">

        <div class="form-group">
            <label for="InputOldPassword">Dein ALTES Passwort:</label>
            <input type="password" class="form-control" id="InputOldPassword" name="old_password"
                   placeholder="Dein ALTES Passwort">
        </div>
        <br>

        <div class="form-group">
            <label for="InputNewPasswort">Dein NEUES Passwort:</label>
            <input type="password" class="form-control" id="InputNewPassword" name="new_password"
                   placeholder="Dein NEUES Passwort">
        </div>

        <div class="form-group">
            <label for="InputNewPasswort">Dein neues Passwort WIEDERHOLEN:</label>
            <input type="password" class="form-control" id="InputNewPassword" name="new_password2"
                   placeholder="Dein neues Passwort WIEDERHOLEN">
        </div>

        <a class="btn btn-secondary" role="button" href="/index.php?page=home">zurück zur Homepage</a>
        <button name="save" class="btn btn-success">Änderung SPEICHERN</button>


    </form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Bitte logge dich ein, um etwas in der Datenbank zu ändern.
<?php endif;
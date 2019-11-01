<?php $this->extend('base'); ?>

    <h1>E-Mail Adresse ändern</h1>

<?php if (isset($new_email_error) && $new_email_error === false):?>
    <div class="alert alert-success" role="alert">
        Deine Email wurde ersetzt!
    </div>
<?php elseif (isset($new_email_error)): ?>
    <div class="alert alert-warning" role="alert">
        <?= $new_email_error ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <form action="?page=change_email" method="post">

        <div class="form-group">
            <label for="InputEmail">Deine neue Email:</label>
            <input type="email" class="form-control" id="InputEmail" name="new_email" placeholder="Deine neue Email">
        </div>


        <div class="form-group">
            <label for="InputPasswort">Gib dein Passwort ein, um deine Änderung zu verifizieren:</label>
            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Dein Passwort">
        </div>

        <a class="btn btn-secondary" role="button" href="/index.php?page=home">zurück zur Homepage</a>
        <button name="save" class="btn btn-success">Änderung SPEICHERN</button>


    </form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Bitte logge dich ein, um etwas in der Datenbank zu ändern.
<?php endif;
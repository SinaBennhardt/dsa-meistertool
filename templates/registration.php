<?php $this->extend('base') ?>

<h1>Registrierung</h1>

<?php if ($registration_error !== null): ?>
    <div class="alert alert-warning" role="alert">
        <?= $registration_error ?? '' ?>
    </div>
<?php endif; ?>

<form action="?page=registration" method="post">

    <div class="form-group">
        <label for="InputUserName">User Name:</label>
        <input type="text" class="form-control" id="InputUserName" name="username">
        <small class="form-text text-muted">Dein Vorname reicht. :)</small>
    </div>

    <div class="form-group">
        <label for="InputEmail1">Email:</label>
        <input type="email" class="form-control" id="InputEmail1" name="email">
        <small class="form-text text-muted">Du wirst deine Email Adresse später zum Einloggen brauchen.</small>
    </div>

    <div class="form-group">
        <label for="InputPassword1">Dein Passwort:</label>
        <input type="password" class="form-control" id="InputPassword1" name="password">
    </div>

    <div class="form-group">
        <label for="InputPassword2">Passwort wiederholen:</label>
        <input type="password" class="form-control" id="InputPassword2" name="password2">
    </div>

    <button name="submit" class="btn btn-success">Registrieren</button>

</form>

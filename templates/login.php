<?php $this->extend('base') ?>

<h1>Log In</h1>

<?php if ($login_error !== null): ?>
    <div class="alert alert-warning" role="alert">
        <?= $login_error ?? '' ?>
    </div>
<?php endif; ?>

<form action="?page=login" method="post">

    <div class="form-group">
        <label for="InputEmail">Email:</label>
        <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Deine Email Adresse">
    </div>

    <div class="form-group" style="max-width: 100%">
        <label for="eInputPassword">Dein Passwort</label>
        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Passwort eingeben">
    </div>

    <button name="submit" class="btn btn-success">Log In</button>


</form>
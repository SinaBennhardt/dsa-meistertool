<?php $this->extend('base') ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <h1>Inhalt hinzufügen</h1>

    <?php if ($add_content_error !== null): ?>
    <div class="alert alert-warning" role="alert">
        <?= $add_content_error?>
    </div>
    <?php endif; ?>

    <form action="?page=add_content" method="post">

        <div class="form-group">
            <h2>Titel: </h2>
            <input type="text" size="100%" name="title">
        </div>

        <div class="form-group">
            <h2>Text:</h2>
            <textarea rows="10" cols="100%" name="text_area"
                      placeholder="Schreibe hier deinen Text hin"></textarea>
        </div>

        <div class="form-group">
            <h3>Wer soll diesen Text lesen können: </h3>
            <select name="readability">
                <option value="all">Jeder</option>
                <option value="restricted">Nur ich (und Admin)</option>
            </select>
        </div>

        <div class="form-group">
            <h3>Schlagwort hinzufügen (optional)</h3>
            <select name="headword">
                <?php foreach ($headword_list as $row): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['headword_name'] ?></option>
                <?php endforeach; ?>
            </select>

        </div>


        <button name="submit" class="btn btn-success">Abschicken</button>

    </form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Bitte logge dich ein, um etwas zur Datenbank hinzuzufügen.
<?php endif;

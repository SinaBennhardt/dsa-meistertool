<?php $this->extend('base') ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <h1>Inhalt ändern</h1>

    <form method="post">
        <div class="form-group">
            <h2>Titel: </h2>
            <input type="text" size="100%" name="title" value="<?= $content['title'] ?>">
        </div>

        <div class="form-group">
            <h2>Text:</h2>
            <textarea rows="10" cols="100%" name="text_area"><?= $content['text'] ?></textarea>
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

        <a class="btn btn-secondary" role="button" href="/index.php?page=view_content">Änderungen VERWERFEN</a>
        <button name="save" class="btn btn-success">Änderungen SPEICHERN</button>

    </form>

<?php else: ?>
    <h1>Du bist nicht eingeloggt.</h1>
    Bitte logge dich ein, um etwas in der Datenbank zu ändern.
<?php endif;


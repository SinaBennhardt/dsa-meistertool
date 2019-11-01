<?php

header('Content-type: text/html; charset=utf-8');
session_start();

require_once __DIR__ . '/View.php';

$pdo = new PDO('mysql:host=localhost;dbname=dsa', 'root', '');
$pdo->exec('SET NAMES utf8');

$view = new View();


if (!isset($_GET['page']) || !$_GET['page']) {

    header('Location: /index.php?page=home');
    exit;

} elseif ($_GET['page'] === 'home') {
    $name = null;

    if (isset($_SESSION['user_id'])) {
        $statement = $pdo->prepare("
            SELECT * 
            FROM user 
            WHERE id = ?
        ");
        $statement->execute(array($_SESSION['user_id']));

        $user = $statement->fetch();

        $name = $user['name'];
    }

    $carousel = true;

    echo $view->render('home', [
        'name' => $name,
        'carousel' => $carousel
    ]);

} elseif ($_GET['page'] === 'registration') {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        //überprüft Username und Passwort

        if ($username === '' || $email === '' || $password === '' || $password2 === '') {
            $registration_error = 'Bitte alle Daten vollständig angeben.';
        } elseif (preg_match('/@/', $email) == 0) {
            $registration_error = "Die E-Mail Adresse ist ungültig.";
        } elseif
        ($password != $password2) {
            $registration_error = 'Die Passwörter müssen übereinstimmen.';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $statement = $pdo->prepare("
                INSERT INTO user (name, email, password) VALUES (?, ?, ?)
            ");
            $status = $statement->execute(array($_POST['username'], $_POST['email'], $password));

            if ($status) {
                $_SESSION['user_id'] = $pdo->lastInsertId();
                header('Location: /index.php?page=home');
                exit;

            } else {
                $registration_error = 'Unter dieser E-Mail ist bereits ein User registriert.';
            }
        }
    }

    echo $view->render('registration', [
        'registration_error' => $registration_error ?? null,
    ]);

} elseif ($_GET['page'] === 'logout') {
    unset($_SESSION['user_id']);

    echo $view->render('logout', []);

} elseif ($_GET['page'] === 'login') {

    if (isset($_POST['email'])) {
        $statement = $pdo->prepare("
            SELECT password 
            FROM user 
            WHERE email = ?
        ");
        $statement->execute(array($_POST['email']));

        $password = $statement->fetch();

        if (password_verify($_POST['password'], $password['password'])) {
            $statement = $pdo->prepare("
                SELECT * 
                FROM user
                WHERE email = ?
            ");
            $statement->execute(array($_POST['email']));

            $user = $statement->fetch();

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header('Location:/index.php?page=home');
                exit;
            } else {
                $login_error = 'Email oder Passwort sind falsch.';
            }
        } else {
            $login_error = 'Email oder Passwort sind falsch.';
        }
    }

    echo $view->render('login', [
        'login_error' => $login_error ?? null,
    ]);

} elseif ($_GET['page'] === 'add_content') {
    $statement = $pdo->prepare("
        SELECT * 
        FROM headword
    ");
    $statement->execute();
    $headword_list = $statement->fetchAll();

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $text_area = $_POST['text_area'];
        $access = $_POST['readability'];
        $headword = $_POST['headword'];

        if ($title === '' || $text_area === '') {
            $add_content_error = 'Du musst beide Felder befüllen.';
        } else {
            if ($headword === 'null') {
                $headword = null;
            } else {
                $headword = (int)$headword;
            }

            $statement = $pdo->prepare("
                INSERT INTO content (title, text, author_id, access, headword_id) VALUES (?, ?, ?, ?, ?)
            ");
            $status = $statement->execute(array($title, $text_area, $_SESSION['user_id'], $access, $headword));

            header('Location: /index.php?page=view_content');
        }
    }

    echo $view->render('add_content', [
        'add_content_error' => $add_content_error ?? null,
        'headword_list' => $headword_list ?? null,
    ]);

} elseif ($_GET['page'] === 'view_content') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $statement = $pdo->prepare("
            SELECT role 
            FROM user
            WHERE id = ?
        ");
        $statement->execute(array($user_id));
        $admin_check = $statement->fetch();

        if ($admin_check['role'] === 'admin') {
            $content = getContents($pdo);

        } elseif ($admin_check['role'] === 'user') {
            $content = getContents($pdo, $user_id);
        }

        $view_content = true;
    } else {
        $view_content = false;
    }

    echo $view->render('view_content', [
        'view_content' => $view_content,
        'content' => $content ?? null,
    ]);;

} elseif ($_GET['page'] === 'update_content') {
    $content_id = ($_GET['id']);
    $statement = $pdo->prepare("
        SELECT * 
        FROM content
        WHERE id = ?
    ");
    $statement->execute(array($content_id));
    $content = $statement->fetch();

    $statement = $pdo->prepare("
        SELECT * FROM headword
    ");
    $statement->execute();
    $headword_list = $statement->fetchAll();

    if (isset($_POST['save'])) {
        $title = $_POST['title'];
        $text_area = $_POST['text_area'];
        $access = $_POST['readability'];
        $headword = $_POST['headword'];

        $statement = $pdo->prepare("
            UPDATE content 
            SET title = ?, text = ?, access = ?, headword_id = ? 
            WHERE id = ?
        ");
        $statement->execute(array($title, $text_area, $access, $headword, $content_id));
        header('Location: /index.php?page=view_content');
    }

    echo $view->render('update_content', [
        'content' => $content ?? null,
        'headword_list' => $headword_list ?? null,
    ]);;

} elseif ($_GET['page'] === 'change_name') {

    if (isset($_POST['save'])) {
        $new_name = $_POST['new_name'];

        $statement = $pdo->prepare("
            UPDATE user 
            SET name = ? 
            WHERE id = ?
        ");
        $statement->execute(array($new_name, $_SESSION['user_id']));
        $change_name_error = false;
    }

    echo $view->render('change_name', [
        'content' => $content ?? null,
        'change_name_error' => $change_name_error ?? null,
        'new_name' => $new_name ?? null,
    ]);;

} elseif ($_GET['page'] === 'change_email') {

    if (isset($_POST['save'])) {
        $new_email = $_POST['new_email'];

        $statement = $pdo->prepare("
            SELECT password 
            FROM user 
            WHERE id = ?
        ");
        $status = $statement->execute(array($_SESSION['user_id']));


        $password = $statement->fetch();

        if (password_verify($_POST['password'], $password['password'])) {
            $statement = $pdo->prepare("
                UPDATE user 
                SET email = ? 
                WHERE id = ?
            ");
            $status = $statement->execute(array($new_email, $_SESSION['user_id']));

            if ($status) {
                $new_email_error = false;
            } else {
                $new_email_error = 'Diese E-Mail Adresse ist bereits vergeben.';
            }

        } else {
            $new_email_error = 'Das Passwort ist falsch.';
        }

    }

    echo $view->render('change_email', [
        'content' => $content ?? null,
        'new_email_error' => $new_email_error ?? null,

    ]);;

} elseif ($_GET['page'] === 'change_password') {

    if (isset($_POST['save'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $new_password2 = $_POST['new_password2'];

        if ($old_password === '' || $new_password === '' || $new_password2 === '') {
            $new_password_error = 'Du musst alle Felder ausfüllen, um dein Passwort zu ändern.';
        } elseif ($new_password != $new_password2) {
            $new_password_error = 'Dein neues Passwort muss beim Wiederholen übereinstimmen';
        } else {
            $statement = $pdo->prepare("
                SELECT password 
                FROM user 
                WHERE id = ?
            ");
            $statement->execute(array($_SESSION['user_id']));

            $db_password = $statement->fetch();

            if (password_verify($old_password, $db_password['password'])) {
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                $statement = $pdo->prepare("
                    UPDATE user
                    SET password = ? 
                    WHERE id = ?
                ");
                $statement->execute(array($new_password_hashed, $_SESSION['user_id']));

                $new_password_error = false;
            } else {
                $new_password_error = 'Das Passwort ist falsch.';
            }
        }
    }

    echo $view->render('change_password', [
        'content' => $content ?? null,
        'new_password_error' => $new_password_error ?? null,
    ]);;

} elseif ($_GET['page'] === 'change_headword') {
    $statement = $pdo->prepare("
        SELECT * 
        FROM headword
    ");
    $statement->execute();
    $all_headwords = $statement->fetchAll();

    if (isset($_POST['save'])) {
        $headword_list = $_POST['headword'];
        foreach ($headword_list as $headword_id => $headword_name) {
            $statement = $pdo->prepare("
                UPDATE headword
                SET headword_name = ?
                WHERE id = ?
          ");
            $statement->execute(array($headword_name, $headword_id));
            header('Location: /index.php?page=change_headword');
        }
    }

    echo $view->render('change_headword', [
        'content' => $content ?? null,
        'all_headwords' => $all_headwords ?? null,
    ]);;

} elseif ($_GET['page'] === 'add_headword') {
    $statement = $pdo->prepare("
        SELECT * 
        FROM headword
    ");
    $statement->execute();
    $all_headwords = $statement->fetchAll();

    if (isset($_POST['save'])) {
        $new_headword = $_POST['new_headword'];

        $statement = $pdo->prepare("
                INSERT headword (headword_name)
                VALUE (?)
          ");

        $statement->execute(array($new_headword));
        header('Location: /index.php?page=add_headword');
    }

    echo $view->render('add_headword', [
        'content' => $content ?? null,
        'all_headwords' => $all_headwords ?? null,
    ]);;

} elseif ($_GET['page'] === 'delete_headword') {

    $statement = $pdo->prepare("
        SELECT * 
        FROM headword
    ");
    $statement->execute();
    $all_headwords = $statement->fetchAll();

    if (isset($_POST['delete_headword'])) {
        $headword_id = $_POST['delete_headword'];

        $statement = $pdo->prepare("
        UPDATE content
        SET headword_id = ?
        WHERE headword_id = ?
    ");
        $statement->execute(array(1, $headword_id));

        $statement = $pdo->prepare("
        DELETE 
        FROM headword
        WHERE id = ?
    ");
        $statement->execute(array($headword_id));

        header('Location: /index.php?page=delete_headword');
    }

    echo $view->render('delete_headword', [
        'content' => $content ?? null,
        'all_headwords' => $all_headwords ?? null,
    ]);;

}

function getContents(PDO $pdo, $user_id = null)
{
    $wheres = [];
    $parameters = [];

    $sql = "SELECT content.*, headword_name, user.name
            FROM content 
            JOIN user ON content.author_id = user.id 
            JOIN headword ON content.headword_id = headword.id 
            ";

    if ($user_id) {
        $wheres[] = "(content.author_id = ? OR content.access = ?)";
        $parameters[] = $user_id;
        $parameters[] = 'all';
    }

    // hier mehr


    if (count($wheres)) {
        $sql .= "WHERE " . implode(' AND ', $wheres);
    }

    $sql .= "ORDER BY content.id";
    $statement = $pdo->prepare($sql);
    $statement->execute($parameters);

    return $statement->fetchAll();
}

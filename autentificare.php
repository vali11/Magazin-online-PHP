<?php
session_start();
include("conectare.php");
if ( mysqli_connect_errno() ) {
    exit('Esec conectare MySQL: ' . mysqli_connect_error());
}
if (isset($_POST['login'])) {
    $id = NULL;
    $username = htmlentities($_POST['username'], ENT_QUOTES);
    $password = htmlentities($_POST['parola'], ENT_QUOTES);

    if ($stmt = $mysqli->prepare('SELECT id, parola FROM utilizatori WHERE username = ?')) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $parola);
            $stmt->fetch();
            if (password_verify($password, $parola) && $username == 'admin') {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                echo 'Bine ati venit' . $_SESSION['name'] . '!';
                header('Location: vizualizare.php');
            } else if (password_verify($_POST['parola'], $parola)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                echo 'Bine ati venit' . $_SESSION['name'] . '!';
                header('Location: acasa.php');
            } else {
                echo 'Incorrect username sau password!';
            }
        } else {
            echo 'Incorrect username sau password!';
        }
    }
} else {
    exit ('Va rugam sa completati datele');
    }
    $mysqli->close();
?>


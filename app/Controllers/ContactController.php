<?php
require_once CONFIG.'/db.php';

$address = conf('contacts');
$title = 'Contact us';
$comments = [];
$error = null;

if (!empty($_POST)) {
    if ( !$_POST['username'] and !$_POST['email'] and !$_POST['message']){
        $error = "Please complete all the fields";
    } else {
        try {
            $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE);
            try {
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === FALSE) {
                  throw new Exception($_POST['email']);
                }
                // $username = mysqli_real_escape_string ($conn, $_POST['username']);
                // $email = mysqli_real_escape_string ($conn, $_POST['email']);
    
                $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $message = mysqli_real_escape_string ($conn, $_POST['message']);
    
                // выполняем операции с базой данных
                $sql = "INSERT INTO guestbook (username, email, message) VALUES ('$username', '$email', '$message')";
                mysqli_query($conn, $sql) or die("Ошибка: " . mysqli_error($conn));
                
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        } catch (Exception $e) {
            $error = mysqli_error($conn);
        } finally {
            // закрываем подключение
            mysqli_close($conn);
        }
    }
}

// ===================================================
try {
    $conn = mysqli_connect(HOST, DBUSER, DBPASSWORD, DATABASE);
    $sql = "SELECT * FROM guestbook";
    $result = mysqli_query($conn, $sql);
    $resCount = mysqli_num_rows($result);

    while($row = mysqli_fetch_assoc($result)){
        array_push($comments, $row);
    }

} catch (Exception $e) {
    $error = mysqli_error($conn);
} finally {
    // закрываем подключение
    mysqli_close($conn);
}

render('contact/index', array(
    'title' => $title,
    'address' => $address,
    'result' => $result,
    'comments' => $comments,
    'error' => $error,
));

// render('guestbook/index', compact('title', 'address', 'result', 'comments', 'error'));

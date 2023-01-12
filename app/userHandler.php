<?php
require_once __DIR__ . '/DB.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'login':
        initSession($_POST['userInput'], $_POST['passwordInput']);
        break;
      case 'logout':
        logOut();
        break;
      default:
        setcookie("errorMessage", "Error Desconocido.", 0, "/");
        header("Location:/error.php");
        break;
    }
  }
}

/**
 * Fetch an specific user from DB
 * @param string $user The user to find
 * @return mixed The user Object, or null if no match.
 */
function fetchUser(string $user) {
  $query = 'SELECT * FROM users WHERE username = ?';
  $values = array($user);
  $result = DB::preparedQuery($query, $values);
  return empty($result[0]) ? null : $result[0];
}

function logOut() {
  session_start();
  $_SESSION['user'] = null;
  session_destroy();
  header("Location:/login.php");
}

function tryUserLogin(string $user, string $pass) {
  $pass = hash('sha256', $pass);
  $userObj = fetchUser($user);
  if (!$userObj) {
    return "'$user' NO EXISTE";
  }
  if ($pass !== $userObj['passwd']) {
    return "CONTRASENA INCORRECTA";
  }

  return true;
}


function initSession(string $username, string $passwd) {
  $result = tryUserLogin($username, $passwd);
  if ($result === true) {
    session_start();
    $_SESSION['user'] = $username;
    header("Location:/");
  } else {
    setcookie("errorMessage", $result, 0, "/");
    header("Location:/error.php");
  }
}


?>
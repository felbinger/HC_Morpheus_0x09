<?php
  if (isset($_POST['login'])) {
    (isset($_POST['lusername'])) ? $username = htmlspecialchars(strip_tags(trim($_POST['lusername']))) : die("Missing parameter lusername");
    (isset($_POST['lpassword'])) ? $password = htmlspecialchars(strip_tags(trim($_POST['lpassword']))) : die("Missing parameter lpassword");

    if (!isset($_COOKIE["session"])) {
      die("Missing session cookie");
    } else {
      $arr = json_decode(base64_decode($_COOKIE['session']), true);
      if (!is_bool($arr["isAdmin"])) {
        die("boolean expected");
      }
      if ($arr["isAdmin"] != true) {
        die("not allowed");
      }
      ($arr["hash"] == md5($_POST['lusername'].$_POST['lpassword']."true")) ? die("Access Granted!") : die("Checksum Error");
    }
  }
  if (isset($_POST["register"])) {
    (isset($_POST['rusername'])) ? $username = htmlspecialchars(strip_tags(trim($_POST['rusername']))) : die("Missing parameter rusername");
    (isset($_POST['rpassword'])) ? $password = htmlspecialchars(strip_tags(trim($_POST['rpassword']))) : die("Missing parameter rpassword");
    $isAdmin = false;
    setcookie("session", base64_encode('{"username": "'.$username.'", "password": "'.$password.'", "isAdmin": '.(($isAdmin) ? 'true' : 'false').', "hash": "'.md5($username.$password.(($isAdmin) ? 'true' : 'false')).'"}'));
    die("account registered");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Admin Login</h1>
    <form method="post">
      Username: <input type="text" name="lusername" required></input></br>
      Password: <input type="text" name="lpassword" required></input></br>
      <input type="submit" name="login" value="Login"></input>
    </form>

    <!-- This feature should be disabled -->
    <div style="display:none !important;">
      <h2>User Registration</h2>
      <form method="post">
        Username: <input type="text" name="rusername" required></input></br>
        Password: <input type="text" name="rpassword" required></input></br>
        <input type="submit" name="register" value="Register"></input>
      </form>
    </div>
  </body>
</html>

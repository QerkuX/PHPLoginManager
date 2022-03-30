<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Manager</title>
</head>
<body>
    <form method="post" action="login.php">
        <input type="text" name="login" placeholder="write login here"></br>
        <input type="password" name="pass" placeholder="write password here"></br>
        <button name="logButt">Log in</button>
        <button name="signButt">Sign in</button>
    </form>
    </br>

    <?php
    session_start();
    echo $_SESSION["noLog"];
    ?>
</body>
</html>
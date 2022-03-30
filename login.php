<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<?php
    //server informations
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "loginmanager";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    function sendCommand($comm, $connect)
    {
        // Write commands
        $sql = $comm;

        // Check commands
        if ($connect->query($sql) === TRUE) {
        } else {
            echo "Error executing command: " . $connect->error;
        }
    }


    session_start();
    $_SESSION["noLog"] = "";
    
    if (isset($_POST["logButt"]))
    {
        if (isset($_POST["login"]) && isset($_POST["pass"]))
        {
            $login = htmlspecialchars($_POST["login"]);
            $pass = htmlspecialchars($_POST["pass"]);
            $id = $conn->query("SELECT id FROM logins WHERE login='$login'");
            if($id->num_rows == 0) 
            {
                $_SESSION["noLog"] = "Login don't exist.";
                header("Location:index.php");
            } 
            else 
            {
                $_SESSION["noLog"] = "";
                while($row = $id->fetch_assoc())
                {
                    $passId = $row["id"];
                }
                $id = $conn->query("SELECT id FROM logins WHERE password='$pass' AND id='$passId'");
                if($id->num_rows == 0) 
                {
                    $_SESSION["noLog"] = "Incorrect password.";
                    header("Location:index.php");
                }
                else
                {
                    $_SESSION["noLog"] = "";
                    echo "Logged in!";
                }
            }
        }
    }

    if (isset($_POST["signButt"]))
    {
        if (isset($_POST["login"]) && isset($_POST["pass"]))
        {
            $login = htmlspecialchars($_POST["login"]);
            $pass = htmlspecialchars($_POST["pass"]);

            $id = $conn->query("SELECT id FROM logins WHERE login='$login'");
            if($id->num_rows == 0) 
            {
                $_SESSION["noLog"] = "";
                sendCommand(
                "INSERT INTO Logins
                VALUES
                (NUll, '$login', '$pass');
                ", $conn);
                echo "You have successfully created an account with the name {$login}!";
            }
            else
            {
                $_SESSION["noLog"] = "Account with that login already exist.";
                header("Location:index.php");
            }
        }
    }

    $conn->close();
    ?>
</body>
</html>
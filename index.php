<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Logg in pols!</title>
    </head>
    <body>
        <?php
        session_start();
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "uppgifter");

        $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

        if (isset($_POST["user"])) {
            $sql = "SELECT * FROM login WHERE user='{$_POST["user"]}' AND pw='{$_POST["pw"]}'";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $pw = $stmt->fetchAll();
            var_dump($pw);
        }
        if (isset($pw[4])) {
            $_SESSION["loggedin"] = 1;
        } else {
            $_SESSION["loggedin"] = null;            
        }
        if (isset($_POST["action"])) {
            if ($_POST["action"] == "Logga ut") {
                $_SESSION["loggedin"] = null;
                header("Location:?");
            }
        }

        if ($_SESSION["loggedin"] == 1) {
            echo "<p>Du är nu inloggad som användare: {$_POST["user"]}</p>";
            echo "<form method='POST'>";
            echo "<input type='submit' name='action' value='Logga ut'>";
        } else {
            echo "<form method='POST'>";
            echo "<table>";
            echo "<tr>";
            echo "<td>";
            echo "<p>Användarnamn: </p>";
            echo "</td>";
            echo "<td>";
            echo "<input type='text' name='user'>";
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>";
            echo "<p>Lösenord: </p>";
            echo "</td>";
            echo "<td>";
            echo "<input type='text' name='pw'>";
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>";
            echo "";
            echo "</td>";
            echo "<td>";
            echo "<input type='submit' name='action' value='Logga in'>";
            echo "</td>";
            echo "</tr>";
            echo "</table";
            echo "</form>";
        }
        ?>
    </body>
</html>

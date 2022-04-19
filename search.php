<?php

$conn = mysqli_connect('localhost', 'root', 'mysql', 'training', 3306);
if (mysqli_connect_errno()) {
    echo("データベースに接続できません:");
}

if (!empty($_GET['name'])) {
    $name = $_GET['name'];
    $query = "select * from users where name ='".$name."';";
} else {
    $query = "select * from users;";
}

$result = mysqli_query($conn, $query);

mysqli_close($conn);

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php
        foreach ($result as $row) {
            echo("<p>名前 : ".$row['name']."</p>");
            echo("<p>年齢 : ".$row['year']."</p>");
            echo("<p>色 : ".$row['color']."</p>");
            echo("<br>");
        }
        ?>
    </body>
</html>
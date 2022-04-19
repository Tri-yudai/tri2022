<?php

$conn = mysqli_connect('localhost', 'root', 'mysql', 'training', 3306);
if (mysqli_connect_errno()) {
    echo("データベースに接続できません:");
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <form action="insert.php" method="post">
            名前<input type="input" name="name"><br>
            年齢<input type="input" name="year"><br>
            色<input type="input" name="color"><br>
            <input type="submit" value="登録">
        </form>
        <p><a href="select.php">一覧に戻る</a></p>
    </body>
</html>
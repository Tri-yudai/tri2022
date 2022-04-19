<?php

//mysqlへの接続  mysqli_connect(ホスト名, ユーザ名, パスワード, データベース名, ポート番号)
$conn = mysqli_connect('localhost', 'root', 'mysql', 'training', 3306);
if (mysqli_connect_errno()) {
    echo("データベースに接続できません:");
}

// 実行するクエリ
$query = "select * from users;";

// mysqli_query(コネクション, クエリ)でクエリを実行
// 成功時は取得したレコードを、失敗時はfalseを返す
$result = mysqli_query($conn, $query);

// コネクションのクローズ
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
            echo("<p>名前 : " . $row['name'] . "</p>");
            echo("<p>年齢 : " . $row['year'] . "</p>");
            echo("<p>好きな色 : " . $row['color'] . "</p>");
            echo("<br>");
        }
        ?>
    </body>
</html>
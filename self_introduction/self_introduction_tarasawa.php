<?php

//mysqlへの接続  mysqli_connect(ホスト名, ユーザ名, パスワード, データベース名, ポート番号)
$conn = mysqli_connect('localhost', 'root', 'mysql', 'training', 33061);
if (mysqli_connect_errno()) {
    echo("データベースに接続できません:");
}

// 実行するクエリ
$query = "select * from self_introductions;";

// mysqli_query(コネクション, クエリ)でクエリを実行
// 成功時は取得したレコードを、失敗時はfalseを返す
$result = mysqli_query($conn, $query);

$randomResult = mysqli_query($conn, "select * from self_introductions order by rand() limit 1;");

if($_GET){
    $searchQuery = "select * from self_introductions where";
    $i = 0;
    foreach($_GET as $key => $val){
        if($val){
            if($i != 0){$searchQuery .= " or";}
            $searchQuery .= " {$key} like '%{$val}%'";
            $i++;
        }
    }
    $searchResult = mysqli_query($conn, $searchQuery);
}

// コネクションのクローズ
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2>検索</h2>
        <form method="GET">
            名前：<input type="text" name="name" />
            趣味：<input type="text" name="favorite" />
            抱負：<input type="text" name="aspiration" />
            <input type="submit" />
        </form>
        <?php
            if(isset($searchResult)){
                echo "<h2>検索結果</h2>";
                foreach ($searchResult as $row) {
                    echo ("<dt>{$row['name']}</dt><dd>趣味: {$row['favorite']}<br />抱負: {$row['aspiration']}</dd>");
                }
            }
        ?>
        <h2>ランダム1件</h2>
            <?php
                foreach ($randomResult as $row) {
            ?>
            <dl>
                <dt><?php echo $row['name']; ?></dt>
                <dd>
                    <?php
                        echo "{$row['favorite']}<br />{$row['aspiration']}";
                    ?>
                </dd>
            </dl>
            <?php } ?>
        <h2>一覧</h2>
        <dl>
        <?php
        foreach ($result as $row) {
            echo ("<dt>{$row['name']}</dt><dd>趣味: {$row['favorite']}<br />抱負: {$row['aspiration']}</dd>");
        }
        ?>
        </dl>
    </body>
</html>
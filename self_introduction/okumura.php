<?php

$name = '奥村俊輔';
$favorite = 'スニーカー';
$aspiration = '立派なエンジニアになれるように頑張ります！';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2>自己紹介</h2>

        <h3>名前</h3>
        <!-- 下の<p>と</p>の間に名前($name)が表示されるようにしてください -->
        <p>
        私の名前は<?php echo $name ?>です<br>
        </p>

        <h3>好きなこと</h3>
        <!-- 下の<p>と</p>の間に好きなこと($favorite)が表示されるようにしてください -->
        <p>
        好きなものは<?php echo $favorite; ?>です<br>
        </p>

        <h3>抱負</h3>
        <!-- 下の<p>と</p>の間に抱負($aspiration)が表示されるようにしてください -->
        <p>
        <?php echo $aspiration; ?><br>
        </p>
        
    </body>
</html>
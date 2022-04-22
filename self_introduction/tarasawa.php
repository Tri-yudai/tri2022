<?php

// ここに自己紹介を入力してください。(各項目255文字以内)
$name = 'たら澤　千聖';
// 趣味
$favorite = '睡眠';
// 抱負
$aspiration = '朝起きれるようになる。寝坊しない。';

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
            <?php
                echo $name;
            ?>
        </p>

        <h3>好きなこと</h3>
        <!-- 下の<p>と</p>の間に好きなこと($favorite)が表示されるようにしてください -->
        <p>
            <?php
                echo $favorite;
            ?>
        </p>

        <h3>抱負</h3>
        <!-- 下の<p>と</p>の間に抱負($aspiration)が表示されるようにしてください -->
        <p>
            <?php
                echo $aspiration;
            ?>
        </p>
        
    </body>
</html>
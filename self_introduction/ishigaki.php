<?php

// ここに自己紹介を入力してください。(各項目255文字以内)
$name = '石垣諒太';
$favorite = 'ゲーム・アニメ鑑賞';
$aspiration = '幅広い分野で知識や技術を得る';

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
            print($name);
            ?>
        </p>

        <h3>好きなこと</h3>
        <!-- 下の<p>と</p>の間に好きなこと($favorite)が表示されるようにしてください -->
        <p>
            <?php
            print($favorite);
            ?>

        </p>

        <h3>抱負</h3>
        <!-- 下の<p>と</p>の間に抱負($aspiration)が表示されるようにしてください -->
        <p>
            <?php
            print($aspiration);
            ?>
        
        </p>
        
    </body>
</html>
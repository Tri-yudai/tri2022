# 新卒技術研修(Git,Webアプリ研修)

## この研修の目標
・PHP,Apache,MySQLでWebアプリケーションを構築し、データベースを操作する機能を実装する。<br>
・(時間に余裕があったら)CSSで画面表示の体裁を整える。

## 準備
### XAMPPのインストール
XAMPP<br>
https://www.webdesignleaves.com/pr/plugins/xampp_01.html<br>
<br>

### リモートリポジトリのクローン
1. https://github.com/tri-tarasawa/tri2022 の「Fork」ボタンを押下<br>
　⇒自分のアカウントに 自分の名前/tri2022　という名前のリポジトリができていることを確認する<br>
2. VSCodeの「Gitリポジトリのクローン」を選択し、ForkしたリポジトリのURLを入力<br>
　⇒リポジトリのURL：https://github.com/自分の名前/tri2022<br>
3. プロジェクトのフォルダを選択<br>
　⇒好きな場所に好きな名前のフォルダを作成して、そのフォルダを選択してください<br>
　　例）C:/Users/tarasawa_chisato/Documents/tri2022<br>

### ApacheのDocumentRootを変更する
XAMPPのコントロールパネルを開き、Apache行のConfigボタン→Apache(httpd.conf)をクリック<br>
httpd.confが開くので、以下のように修正
```
DocumentRoot "C:/Users/tarasawa_chisato/Documents/tri2022"
<Directory "C:/Users/tarasawa_chisato/Documents/tri2022">
```
Apacheを再起動(Stopボタンを押して再度Start)し、<br>
Chromeで"localhost/hello.html"にアクセス<br>
「2022年新卒技術研修」と表示されていたらOK！<br>
<br>
以上で準備完了！<br>

### ブランチの作成
1. 画面左下の master をクリックし、 Create new branch... をクリック<br>
2. ブランチ名を入力<br>
　⇒ブランチ名はbranch_苗字で<br>

### ファイルの編集
ここからはそれぞれ作っていただいたブランチ上での作業になります。<br>
画面下部の青いバーの左側に自分が作成したブランチ名が表示されていることを確認してください。<br>
例）branch_tarasawa
1. self_introductionディレクトリのtemplate.phpを同ディレクトリにコピーし、ファイル名を自分の苗字.phpに変更<br>
2. 作成したファイルに自己紹介を入力<br>
3. Chromeで"localhost/self_introduction/作ったファイル名"<br>
にアクセスした時、自己紹介が表示されるようにHTML内でPHPを書く。<br>

### Gitの操作
"localhost/self/introduction/作ったファイル名"で自己紹介が表示されるようになったら、<br>
そのファイルを自分のリポジトリにプッシュして、tri-tarasawa/tri2022 にプルリクエストを送ってください。<br>

## データベースの接続
tri2022/select.phpをVSCodeで開いてみてください。<br>
このファイルではデータベースに接続し、データを出力するという処理が書かれています。<br>
しかし、この処理を呼び出すためにChromeで"localhost/select.php"にアクセスしても、<br>
「データベースに接続できません」とメッセージが表示されるはずです。<br>
まずはこの処理がうまく動くように準備をします。<br>

### MySQLの起動
XAMMPのコントロールパネルのMySQL行の一番左のボタン「start」を押すと起動<br>

### MySQL rootアカウントのパスワードを変更する
```
# C:/xampp/mysql/binに移動
cd C:/xampp/mysql/bin

# 次のように実行
mysqladmin -u root password
# 新しいパスワードの入力待ちになるので、パスワードを「mysql」としてください
```

### PowerShellでMySQLに接続、データベース、テーブルの作成
```
# C:/xampp/mysql/binで
./mysql -u root -p

# パスワードを入力(mysql)

# データベース一覧を確認
show databases;

# データベースを作成(名前はtraining)
create database training;

# show databases;でtrainingが追加されているかを確認

# trainingを選択
use training;

# usersテーブルを作成
# "id"テーブル: integer　・・・数値
#　　　　　　　　AUTO_INCREMENT ・・・自動で連続した数字をつけていく
# "name"カラム: varchar(255) ・・・255字の文字列
# "year"カラム: integer ・・・数値
# "color"カラム: varchar(255) ・・・255字の文字列
# "created_at"カラム: datetime ・・・yyyy/mm/dd hh:mm:ssの時間（例：2022/04/21 19:40:00）
# 最後のPRIMARY KEY(id)は、id カラムの値はほかのレコードとは被らないもの（要は主キー）
create table users (
id integer AUTO_INCREMENT,
name varchar(255),
year integer,
color varchar(255),
created_at datetime,
PRIMARY KEY (id)
);

# usersテーブルが作られたかを確認
show tables;

# usersテーブルのカラムの確認
desc users;

# データの登録(以下のSQLを実行)
insert into users values(null, '佐藤', 59, '黄', '2021-04-20 12:00:00'),
(null, '田中', 28, '黒', '2021-04-20 12:00:00'),
(null, '山田', 14, '白', '2021-04-20 12:00:00')
;

# select * from users; でデータが取得できればOK！
```
ちなみに、テーブルを作成するCREATE文で使用した、integerとか、varchar(255)とかは、他にもかなりの数があり、それぞれ入れられるデータが異なります。<br>
https://www.dbonline.jp/mysql/type/<br>
<br>

### select.phpの編集
```
// この部分を修正(引数の3つ目と4つ目を変更してください)
$conn = mysqli_connect('localhost', 'root', '設定したパスワード', '作ったデータベース名', 3306);
```
localhost/select.phpにアクセスして、先ほど登録したデータが表示されていれば成功！

### Webのしくみ
https://developer.mozilla.org/ja/docs/Learn/Getting_started_with_the_web/How_the_Web_works

## 自己紹介一覧ページの作成
### DBに自己紹介を登録
```
# PowerShellで再度MySQLに接続
./mysql -u root -p
use training;

# self_introductionsテーブルの作成
# 以下の条件のid, name, favorite, aspirationを列に持つテーブル「self_introductions」テーブルを作成するSQLを実行してください。

id        : integer型、自動採番
name      : 上限を255文字とした可変長文字
favorite  : 上限を255文字とした可変長文字
aspiration: 上限を255文字とした可変長文字

# 講師から渡されたSQL(皆さんの自己紹介を登録するSQL)を実行
insert into self_introductions values 
(null, '青柳早織', 'KPOP', '仕事を早く覚える'),
(null, '古池遥樹', 'バイク', '頑張る'),
(null, 'ゆうま', 'ごはん', 'いっぱい食べる'),
(null, '一ノ坪', 'ライブいくこと', '痩せる'),
(null, '飯野成美', 'じゃがりこ', '健康に仕事を頑張る'),
(null, '石垣諒太', 'ゲーム・アニメ鑑賞', '幅広い分野で知識や技術を得る'),
(null, '三好一輝', '野球', 'こいつに任せれば大丈夫と言われるエンジニアになる。'),
(null, 'mouri umi', 'to read books', 'to be stronger'),
(null, '長沢賢太', '卓球をすることです', 'ブロックチェーンのシステムを作る'),
(null, '中野健', '漫画、アニメ', 'どこでもドアが欲しい'),
(null, '大山　理沙子', 'お出かけ', '毎日頑張る'),
(null, '岡本樹', 'ああ', '立派なエンジニアになります'),
(null, '奥村俊輔', 'スニーカー', '立派なエンジニアになれるように頑張ります！'),
(null, '大瀧莉央', '将棋', 'テクノロジーで世界を創っていきます'),
(null, '小澤彩花', 'ラクロス', '努力し続ける'),
(null, '阪上将也', 'お昼寝', 'とにかく頑張る'),
(null, '高野渓太', 'サウナ', 'がんばります'),
(null, '田中蓮', '野球', '頑張るぞ'),
(null, 'たら澤　千聖', '睡眠', '朝起きれるようになる。寝坊しない。'),
(null, '土屋大貴', '競馬', 'AI技術を使ってお金を生み出すソフトウェアを作成する'),
(null, 'Kaine Yamashiro', 'Snow bording, surfing, to watch anime', 'I wanna be ultimate engineer'),
(null, 'yano', 'movie', 'to be rich');



# select * from self_introductions; でレコードが取り出せたらOK！
```

### 自己紹介一覧ページ
tri2022/self_introduction/の下にself_introductions_苗字.phpを作成し、<br>
自己紹介の一覧を表示する機能を作ってみましょう。<br>
tri2022/select.phpを参考にしてください。<br>
<br>
余裕のある人は...<br>
一覧表示ではなく、ランダムで1人の自己紹介だけ表示する機能を作ってみてください。(以下を参考)
https://www.javadrive.jp/phpfunc/math/index1.html

```
# ヒント
# $resultから1レコードだけ取り出すには、

$row = $result->fetch_row();

# を使う
```

## 検索機能の実装
### リクエストパラメータに検索項目を入力してみる
localhost/search.phpにアクセスすると、<br>
usersテーブルのレコード一覧が表示されます。<br>
<br>
次にlocalhost/search.php?name=佐藤<br>
とすると、佐藤さんだけが画面に表示されるようになります。<br>
<br>
### 検索バーを追加する
```
# search.phpの<body>のすぐ下に、以下のようなフォームタグを追加します。
<form action="search.php" method="get">
    名前<input type="search" name="name"><br>
    <input type="submit" value="検索">
</form>
```

### 検索項目を追加する
名前の検索バーだけでなく、年齢、色の検索バーも追加して検索が行えるようにしましょう！<br>
<br>
余裕のある人は...<br>
一致条件を完全一致から部分一致に修正してみましょう！<br>
ex) "藤"で検索すると佐藤さんが取得できる
<br>

### 自己紹介検索ページを作ってみよう！
search.phpを参考に、自己紹介検索ページを作ってみてください。<br>
ファイル名はintroduction_search_苗字.php<br>
<br>

## 共有のGitにプッシュする(2022/04/25)
今まで tri-tarasawa/tri2022 リポジトリからForkして、ブランチを作成してプッシュしていましたが、<br>
Backlogというタスクとか、進捗とか管理できるツールの中のGitHubに近い機能を使用して「共有のリポジトリにプッシュする」という実際の開発に近いことを行っていきます。<br>
<br>
まずはBacklogのプロジェクトに招待するため、みなさんの会社メールアドレスを tarasawa_chisato@3-ize.jp にチャットで送ってください。<br>
<br>
Backlog招待されるまでの間、tri-tarasawa/tri2022 のmasterブランチをプルして、colors.txtの2行目に1行目を参考にして自身の好きな色を2種類、16進数で入力してください。<br>
参考：<br>
https://www.colordic.org/s<br>
https://color.adobe.com/ja/create/color-wheel<br>
<br>
<br>
招待が来たら、自分で`self_自分の名前`でブランチを作成し、<br>
`self_introduction/self_introductions_名前.php`と、`colors.txt`をコミットし、GitのURLを以下に変更した後、プッシュしてみてください<br>

```
GitのURL：https://3ize.backlog.jp/git/NPP/tri2022.git

#プッシュ先変更方法
#金曜日に tri-tarasawa/tri2022 をプルしたフォルダに移動する
cd c:/users/自分の名前/Documents/tri2022

#以下のコマンドでプッシュ先のURLを設定する
git remote set-url origin https://3ize.backlog.jp/git/NPP/tri2022.git

#変更できたか確認
git remote -v
```

プッシュが完了したら、https://3ize.backlog.jp/git/NPP/tri2022/tree/ブランチ名 にアクセスし、自分がプッシュした内容が表示されることを確認してください<br>


## 追加機能の実装 (2022/04/25)
### usersテーブルのレコード追加機能
usersテーブルにレコードを追加する機能を実装します。<br>
(insert.phpを編集)<br>

### 自己紹介ページにQRコードを表示させる
QRコードを生成するPHPのライブラリが世の中にあるので、こちらを使用して自己紹介ページにQRコードをつけていきます。

インストールするアプリケーション
・Composer

手順
1. tri2022 フォルダ内に composer.json ファイルを作成し、以下の内容を入力する
```
{
    "require": {
        "tecnickcom/tc-lib-barcode": "^1.15"
    }
}

```
2. コマンドプロンプトまたはパワーシェルで、tri2022フォルダに移動した後、以下のコマンドを入力する
```
composer install
```
3. `localhost/qrtest.php`を開いて、QRコードが表示されたら成功。スマホで読んでみるとGoogleにつながる。

### usersテーブルと、他のテーブルを連結する
現状のusersテーブルでは、名前、趣味、抱負しか入れることができませんが、新たなテーブルを作成して、結合すれば1人あたりのデータを無限に増やすことができます。<br>
（カラムを増やすだけで対応できるけど…）<br>
■準備<br>
`colors.txt`に自分の好きな色を以下のように2つ入力して、colors.txtをBacklogのGitにプッシュしてください<br>

以下の条件で新規テーブルを作成してください。<br>
<br>
■テーブル名<br>
colors<br>
<br>
■カラム
|カラム名|型|NOT NULL|自動採番|
|----|----|----|----|
|id|integer|○|○|
|self_introduction_id|integer|○||
|foregroundr|varchar(255)|○||
|background|varchar(255)|○||

■プライマリーキー<br>
id, self_introduction_id<br>
■テーブルに挿入するデータ<br>
```
後で作成します。
```

テーブルを作成したら、PHPを書く前に以下のSQL文を叩いてusersテーブルとcolorsテーブルが一緒に出力されることを確認してください<br>
```
SELECT self_introductions.*, colors.self_introduction_id, colors.foreground, colors.background FROM self_introductions
INNER JOIN colors
ON self_introductions.id = colors.self_introduction_id;
```
⇒これは、usersテーブルのIDと、colorsテーブルのuser_idが一致するデータを連結して取得しています。<br>
例えば・・・<br>
■self_introductionsテーブル<br>
|id|name|favorite|aspiration|
|--|--|--|--|
|1|人間|ゲーム|遅刻しない|
|2|犬|散歩|走らない|
|4|猫|睡眠|障子破らない|
|5|熊|狩り|人間を狩らない|

<br>

■colorsテーブル<br>
|id|self_introduction_id|foreground|background|
|--|--|--|--|
|1|1|#000000|#FFFFFF|
|2|2|#EFEFEF|#CCCCCC|
|3|4|#00FF00|#FF0000|
|4|9|#CCCCCC|#000000|

<br>

があったとして、先ほどのコマンドを実行すると、以下の結果が表示されるはずです。<br>
|id|name|favorite|aspiration|self_introduction_id|foreground|background|
|--|--|--|--|--|--|--|
|1|人間|ゲーム|遅刻しない|1|#000000|#FFFFFF|
|2|犬|散歩|走らない|2|#EFEFEF|#CCCCCC|
|4|猫|睡眠|障子破らない|4|#00FF00|#FF0000|

colorsテーブルのidは、select文の最初で表示しないようにしているため、出力されません<br>
また、users.id=5の熊は、colors.user_id=5がないので、出力されません。<br>
colors.id=4は、users.id=9がないため、こちらも出力されません<br>
<br>

### 自己紹介ページに反映する
qrTest.php を参考に、自己紹介ページ `self_introduction/self_introductions_名前.php` に、colorsテーブルの色で、今いるURLのQRコードを表示するPHPを書く<br>
<br>
■ヒント
* `getBarcodeObj` 2番目の引数に今いるページのURLを取得して使用する
* `getBarcodeObj` 5番目の引数にQRコードの黒い部分の色を、usersテーブルのidに紐づくcolorsテーブルのforeground の値が入るようにする
* `getBarcodeObj` の後、`setBackgroundColor` に、usersテーブルのidに紐づくcolorsテーブルのbackground の値が入るようにする


<!-- ツール系の紹介
・SourceTree
・ngrok　⇒　exeをpathに入れてcmdで実行する
・BacklogのGitに新卒の方々を追加して、人のリポジトリにプッシュするとか
・Composerのインストール、composer.jsonのrequire、自分の好きな内容を入れたQRコードを作成する（これを自己紹介ページに貼り付けるとかいいよね）
・CSSやろう -->
<br>

## やることなくなったら...
### ngrok を使用して今自分が作った自己紹介ページにスマホでアクセスしてみる
https://ngrok.com/<br>
https://qiita.com/yamatmoo/items/8d5c2ffe6edf54c91957<br>
<br>

### PHPの基礎 or HTML,CSSの学習 or JavaScript予習(自習形式)
* プログラミングが初めて、またはPHPに自信がない人は...<br>
プロゲートでPHPの学習を進める(会社のメールアドレスで会員登録してOKです)<br>
https://prog-8.com/courses/php<br>

* PHPは大体OK、webページのデザインについて知りたい人<br>
HTML→「HTMLを始めよう」から「ハイパーリンクの作成」まで学習を進めてください。<br>
https://developer.mozilla.org/ja/docs/Learn/HTML/Introduction_to_HTML/Getting_started<br>
CSS→「CSSとは何か？」から「新しい知識を使う」まで学習を進めてください。<br>
https://developer.mozilla.org/ja/docs/Learn/CSS/First_steps/What_is_CSS

* PHPもHTML,CSSも余裕！という人<br>
JavaScriptの予習を行ってください。 <br>
https://developer.mozilla.org/ja/docs/Learn/JavaScript/First_steps/What_is_JavaScript

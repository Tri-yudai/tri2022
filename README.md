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

## 追加機能の実装
### usersテーブルのレコード追加機能
usersテーブルにレコードを追加する機能を実装します。<br>
(insert.phpを編集)<br>
<br>
## PHPの基礎 or HTML,CSSの学習 or JavaScript予習(自習形式)
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

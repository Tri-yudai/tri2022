# 新卒技術研修(Git,Webアプリ研修)

## この研修の目標
・Gitについて理解し、基礎的なGitコマンドが打てるようになる。<br>
・PHP,Apache,MySQLでWebアプリケーションを構築し、データベースを操作する機能を実装する。<br>
・(時間に余裕があったら)CSSで画面表示の体裁を整える。

## 準備
### GitHubアカウントの作成
こちらの記事を参考にgithubアカウントを作成してください。<br>
ユーザ名は「triple-苗字」でお願いします。<br>
https://tonari-it.com/github-signup/<br>
<br>

### VsCode, Git, XAMPPのインストール
以下の記事を参考にインストールを行ってください。<br><br>
VsCode<br>
https://qiita.com/Shi-nakaya/items/c43fb6c1e638d51bf1c8<br>
<br>
Git<br>
https://prog-8.com/docs/git-env-win<br>
<br>
XAMPP<br>
https://www.webdesignleaves.com/pr/plugins/xampp_01.html<br>
<br>

### リモートリポジトリのクローン
```
# PowerShellを開いて
# 現在のディレクトリを確認
pwd

# こんな感じで表示されていたらOK
# path
# ----
# C:￥\Users￥名前

# もし違ったら
cd ~

# と打ってから
pwd

# とすればOK
# ※cd ~ の「~」は、ホームディレクトリ(Windowsでは"C:￥Users￥名前)を示します

# このディレクトリ下にprojectsディレクトリを作成
mkdir projects

# projectsディレクトリに移動
cd projects

# 研修用のリモートリポジトリをクローン
git clone https://github.com/triple-hirano/training_2021

# projectsディレクトリの下に「training_2021」ディレクトリが作成されていればクローン成功！

# ユーザ名とメールアドレスを登録する

# training_2021ディレクトリに移動
cd training_2021

# ユーザ名の登録
git config --local user.name "githubのユーザ名"

# メールアドレスの登録
git config --local user.email githubに登録したメールアドレス(「"」はつけない)
```

### ApacheのDocumentRootを変更する
XAMPPのコントロールパネルを開き、Apache行のConfigボタン→Apache(httpd.conf)をクリック<br>
httpd.confが開くので、以下のように修正
```
DocumentRoot "C:/Users/名前/projects/training_2021"
<Directory "C:/Users/名前/projects/training_2021">
```
Apacheを再起動(Stopボタンを押して再度Start)し、<br>
Chromeで"localhost/hello.html"にアクセス<br>
「2021年新卒技術研修」と表示されていたらOK！<br>
<br>
以上で準備完了！<br>

# Gitについて
まずは、こちらのサイトのGitの基本「Gitを使ったバージョン管理」から「ワークツリーとインデックス」まで読んでみてください。(15分想定)<br>
https://backlog.com/ja/git-tutorial/intro/01/<br>
```
キーワード
・リモートリポジトリ
・ローカルリポジトリ
・ワークツリー
・インデックス
```
<br>
入門の動画↓<br>
https://youtu.be/i1L3A0SLDyg<br>
<br>
<img width="864" alt="git" src="https://user-images.githubusercontent.com/81727205/114349757-47b5bf80-9ba3-11eb-8c5e-bf8cabcd7a7f.PNG">

## 実践
```
ここで使うgitコマンド
・git branch
・git checkout
・git status
・git add
・git commit
・git push
・git pull
```

### ブランチの作成
```
# PowerShellで~/projects/training_2021に移動し
git branch

# * master
# と表示されていると思います

# ブランチの作成(ブランチ名はbranch_苗字でお願いします)
git checkout -b branch_苗字

# 再度
git branch

# とすると、
# * branch_苗字
#   master
# と表示されていると思います。
# 「*」がついたブランチが現在作業しているブランチとなります。

# ブランチの切り替え
git checkout ブランチ名
```

### ファイルの編集
ここからはそれぞれ作っていただいたブランチ上での作業になります。<br>
git branch コマンドで正しいブランチにいるか確認してください。<br>
1. VsCodeでtraining_2021フォルダを開く<br>
2. self_introductionディレクトリのname.phpを同ディレクトリにコピーし、ファイル名を自分の苗字.phpに変更<br>
3. 作成したファイルに自己紹介を入力<br>
4. Chromeで"localhost/self_introduction/作ったファイル名"
にアクセスした時、自己紹介が表示されるようにする。

### Gitの操作
```
# PowerShellで~/projects/training_2021に移動し、
git status

# 編集したファイルをインデックスに追加
git add ファイル名

# インデックスに追加したファイルをコミット
git commit -m 'コミットメッセージ'

# リモートリポジトリにプッシュ
 git push --set-upstream origin 自分のブランチ名

# 講師によるmasterブランチへのマージ作業が完了したら
# masterブランチに移動して、リモートリポジトリの変更分をローカルに持ってくる
git checkout master
git pull

# masterブランチの変更分を、自分のブランチに反映させる
git checkout 自分のブランチ名
git merge master

# 他の人の自己紹介も見れるようになっていればOK！
```

## データベースの接続
training_2021/select.phpをVSCodeで開いてみてください。<br>
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

# usersテーブルを作成(以下のSQLを実行)
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

※usersテーブル作成のSQLを参考にしてください。
答え
create table self_introductions (
id integer AUTO_INCREMENT,
name varchar(255),
favorite varchar(255),
aspiration varchar(255),
PRIMARY KEY (id)
);

# 講師から渡されたSQL(皆さんの自己紹介を登録するSQL)を実行
insert into self_introductions values
(null, '早田優希', '睡眠', '頑張ります!'),
(null, '平野洸志', '囲碁の観戦', 'よろしくお願いします'),
(null, '飯田　遥香', 'お酒', '抱負'),
(null, '今井琉偉', '筋トレ', 'がんばりまあす'),
(null, '石川峻也', '好きなこと', '抱負'),
(null, '川口航平', '囲碁を打つこと', '自分より強く、自分に似た打ち方をする囲碁AIを作成できる程度の能力を身につける'),
(null, '川島 寛生', '好きなこと', '抱負'),
(null, '森下大地', '囲碁', '頑張ります'),
(null, '村上雄亮', '映画鑑賞', '頑張ります'),
(null, 'おがたじゅん', 'げーむ', 'がんばります'),
(null, '大隈康平', 'ねること', 'がんばる'),
(null, '砂原　圭輔', '合コン', '頑張る'),
(null, '鈴木章記', 'ゲーム', 'よろしくお願いいたします'),
(null, '高田', 'ギター', '頑張ります'),
(null, '谷口光', '好きなこと', '抱負'),
(null, '梅津丈誠', '音楽', '友達１００人作りたい'),
(null, '八木和也', '映画', '頑張ります'),
(null, '涌田朋幸', '食べること', '頑張ります')
;

# select * from self_introductions; でレコードが取り出せたらOK！
```

### 自己紹介一覧ページ
training_2021/self_introduction/の下にself_introductions_苗字.phpを作成し、<br>
自己紹介の一覧を表示する機能を作ってみましょう。<br>
training_2021/select.phpを参考にしてください。<br>
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

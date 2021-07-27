<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>テーブルを作成</title>
    </head>
    <body>
        <?php
            //データベース接続設定
            
            $dsn="mysql:dbname=データベース名;host=ホスト名";
            //dsn：data source name
            
            $user = "ユーザー名";
            
            $password = "パスワード";
            
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            //new：クラスやデータベースを初期化する
            //アロー演算子(=>)：インスタンスのプロパティやメソッドにアクセスする
            //スコープ定義演算子(::)：クラスのプロパティやメソッドにアクセスする
            //PDO：PHPとデータベースの間に入って、1つの命令でそれぞれのデータベースにいい感じにアクセスしてくれる
            //ATTR：attributeの略(？)で、情報の属性を示す(？)
            
            
            //テーブルを作成
            
            $sql = "CREATE TABLE IF NOT EXISTS tbtest"
            //SQL：データベース内に保存されているデータを取得したり、検索したりする時などに使う言語
            //CREATE TABLE：PDOを使ってテーブルを作成するときのSQL
            
            ."("
            
            ."id INT AUTO_INCREMENT PRIMARY KEY,"
            //increment：増加
            //AUTO_INCREMENT：自動連番の整数を設定
            
            ."name char(32),"
            
            ."comment TEXT"
            
            .");";
            
            $stmt = $pdo -> query($sql);
            //$stmt：statementの略で、実行後にSQLの実行結果に関する情報を得たい場合に使う(必須ではない)
            //query：指定したSQL文をデータベースに届ける(ユーザからの入力情報を含まない)
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>テーブルを表示</title>
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
            
            
            //テーブルを表示
            $sql = "SHOW TABLES";
            //SHOW TABLES：テーブル名を取得
            
            $result = $pdo -> query($sql);
            
            foreach ($result as $row) {
                echo $row[0];
                echo "<br>";
            }
            echo "<hr>";
        ?>
    </body>
</html>
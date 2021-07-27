<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>データを表示</title>
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
            
            
            //データを表示
            $sql = "SELECT * FROM tbtest";
            //SELECT：テーブルにある全てのデータを取得する
            
            $stmt = $pdo -> query($sql);
            $results = $stmt -> fetchAll();
            //fetchAll：結果データを全件まとめて配列で取得する
            
            foreach ($results as $row) {
                echo $row["id"].",";
                echo $row["name"].",";
                echo $row["comment"]."<br>";
                echo "<hr>";
            }
        ?>
    </body>
</html>
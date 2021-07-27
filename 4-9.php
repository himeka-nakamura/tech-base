<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>テーブルを削除</title>
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
            
            
            //テーブルを削除
            $sql = "DROP TABLE 5_1";
            //作成済みのテーブルと、格納されているデータ、テーブルに対するトリガが削除される
            
            $stmt = $pdo -> query($sql);
        ?>
    </body>
</html>
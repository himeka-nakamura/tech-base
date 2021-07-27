<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>データを編集</title>
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
            
            
            //データを編集
            $id = 1;
            $name = "アケミ";
            $comment = "こんばんみ！";
            $sql = "UPDATE tbtest SET name=:name, comment=:comment WHERE id=:id";
            //UPDATE：データを修正・更新
            //SET：更新する値
            //WHERE：更新する条件
            
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindParam(":name", $name, PDO::PARAM_STR);
            $stmt -> bindParam(":comment", $comment, PDO::PARAM_STR);
            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
            $stmt -> execute();
            
            
            //データを表示
            $sql = "SELECT * FROM tbtest";
            $stmt = $pdo -> query($sql);
            $results = $stmt -> fetchAll();
            foreach ($results as $row) {
                echo $row["id"].",";
                echo $row["name"].",";
                echo $row["comment"]."<br>";
                echo "<hr>";
            }
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>データを登録</title>
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
            
            
            //データを登録
            $sql = $pdo -> prepare("INSERT INTO tbtest(name, comment) VALUES(:name, :comment)");
            //prepare：ユーザからの入力情報を含むSQLを実行する
            
            $sql -> bindParam(":name", $name, PDO::PARAM_STR);
            //bindParam：プリペアドステートメントで使用するSQL文の中で、プレースホルダーに値をバインドする(結び付ける)ための関数
            //プリペアドステートメント：SQL文で値が変わる可能性がある箇所に対して、変数のように別の文字を入れておき、後で置き換える仕組み
            
            $sql -> bindParam(":comment", $comment, PDO::PARAM_STR);
            $name = "あけみ";
            $comment = "やっほ♪";
            $sql -> execute();
            //execute：プリペアドステートメントを実行する時に使われる関数
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>のびちゃんねる</title>
    </head>
    <body>
        <?php
            //データベース接続設定
            $dsn="mysql:dbname=データベース名;host=ホスト名";
            $user = "ユーザー名";
            $password = "パスワード";
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            //テーブルを作成
            $sql = "CREATE TABLE IF NOT EXISTS 5_1"//テーブル名
            ."("
            ."id INT AUTO_INCREMENT PRIMARY KEY,"//投稿番号
            ."name char(32),"//名前
            ."comment TEXT,"//コメント
            ."date DATETIME,"//投稿日時
            ."password varchar(10)"//パスワード
            .");";
            $stmt = $pdo -> query($sql);
        
            //投稿フォーム
            $number = isset($_POST["number"]) ? $_POST["number"] : NULL;
            $name = isset($_POST["name"]) ? $_POST["name"] : NULL;
            $comment = isset($_POST["comment"]) ? $_POST["comment"] : NULL;
            $password = isset($_POST["password"]) ? $_POST["password"] : NULL;
            $date = date("Y/m/d H:i:s");
            $edit_number = "";
            $edit_name = "";
            $edit_comment = "";
            $edit_password = "";
            if(!empty($_POST["name"]) && !empty($_POST["comment"])){//名前とコメントが空でない場合
                if (!empty($password)) {//パスワードが空でない場合
                    $name = $_POST["name"];
                    $comment = $_POST["comment"];
                    
                    if(!empty($_POST["number"])) {//コメント番号が空でない場合
                        $sql = "SELECT * FROM 5_1";//登録済みのデータを抽出
                        $stmt = $pdo -> query($sql);
                        $results = $stmt -> fetchAll();
                
                        foreach($results as $row) {
                
                            if($row["id"] == $number) {//番号が一致する場合
                                $id = $_POST["number"];
                                $name = $name;
                                $comment = $comment;
                                $password = $password;
                                
                                //データを編集する
                                $sql = "UPDATE 5_1 SET name=:name, comment=:comment, date=CURRENT_TIMESTAMP WHERE id=:id";
                                $stmt = $pdo -> prepare($sql);
                                $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                                $stmt -> bindParam(":name", $name, PDO::PARAM_STR);
                                $stmt -> bindParam(":comment", $comment, PDO::PARAM_STR);
                                $stmt -> execute();
                            }
                        }
                    }
                    else {//コメント番号が空である場合
                        //新規投稿としてデータを登録
                        $sql = $pdo -> prepare("INSERT INTO 5_1 (name, comment, date, password) VALUES(:name, :comment, :date, :password)");
                        $sql -> bindParam(":name", $name, PDO::PARAM_STR);
                        $sql -> bindParam(":comment", $comment, PDO::PARAM_STR);
                        $sql -> bindParam(":date", $date, PDO::PARAM_STR);
                        $sql -> bindParam(":password", $password, PDO::PARAM_STR);
                        $sql -> execute();
                    }
                }
            }
            
            //削除フォーム
            $delete = isset($_POST["delete"]) ? $_POST["delete"] : NULL;
            $delete_password = isset($_POST["delete_password"]) ? $_POST["delete_password"] : NULL;
            
            //編集フォーム
            $edit = isset($_POST["edit"]) ? $_POST["edit"] : NULL;
            $edit_password = isset($_POST["edit_password"]) ? $_POST["edit_password"] : NULL;
            if (!empty($edit_password)) {
                $sql = "SELECT * FROM 5_1";//登録済みのデータを抽出
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                
                foreach ($results as $row) {
                    
                    if ($row["id"] == $edit && $row["password"] == $edit_password) {//編集番号とパスワードが元の投稿と一致する場合
                        //投稿番号・名前・コメント・パスワードを取得して投稿フォームに表示させる
                        $edit_number = $row["id"];
                        $edit_name = $row["name"];
                        $edit_comment = $row["comment"];
                        $edit_password = $row["password"];
                    }
                }
            }
        ?>
        
        <p>ようこそ(^-^)</p>
        <hr>
        <form action="" method="post" name="form-comment">
            <input type="hidden" name="number" style="height:30px;" placeholder="コメント番号" value="<?php echo $edit_number;?>">
            <input type="text" name="name" style="height:30px;" placeholder="名前" value="<?php echo $edit_name;?>">
            <input type="text" name="comment" style="height:30px; width:200px;" placeholder="コメント" value="<?php echo $edit_comment;?>">
            <input type="password" name="password" style="height:30px; width:200px;" placeholder="パスワード" value="<?php echo $edit_password;?>">
            <input type="submit" value="☆送信☆">
        </form>
        <?php
            if (!empty($delete)) {
                echo "<p>もっと何か書いて〜っ！(ﾉ*>∀<)ﾉ</p>";
            }
            elseif (!empty($edit)) {
                $error = "<p>編集して送信しよう！( ＾∀＾)</p>";
                echo $error;
            }
            elseif (!isset($comment)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も送信されてないよ(´・∀・｀)</p>";
                echo $error;
            }
            elseif (empty($password)) {
                $error = "<p>ぱしゅわーどを入れてちょ(・ω・｀)</p>";
                echo $error;
            }
            elseif (!empty($_POST["name"]) && !empty($_POST["comment"])) {//名前とコメントが空でない場合
                if (!empty($_POST["number"])) {//コメント番号が空でない場合
                        echo "<p>編集できたよ！((o(^∇^)o))</p>";
                }
                else {//コメント番号が空である場合
                    echo "<p>送信できたよ！(((o(*ﾟ▽ﾟ*)o)))</p>";
                }
            }
            elseif (empty($name) && empty($comment)) {//名前もコメントも未入力の場合
                $error = "<p>何でもいいから入力してね(^p^)</p>";
                echo $error;
            }
            elseif (empty($name)) {//名前が未入力の場合
                $error = "<p>君の名は？( *｀ω´)</p>";
                echo $error;
            }
            elseif (empty($comment)) {//コメントが未入力の場合
                $error = "<p>コメントも欲しいのである(´･ω･`)</p>";
                echo $error;
            }
        ?>
        
        <hr>
        <p>削除したいコメントの番号を教えてね( ；∀；)</p>
        <form action="" method="post" name="form-delete">
            <input type="number" name="delete" style="height:30px;" placeholder="コメント番号">
            <input type="password" name="delete_password" style="height:30px;" placeholder="パスワード">
            <input type="submit" value="削除！">
        </form>
        <?php
            if (!isset($delete)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も削除してないよ(*´∀`)♪</p>";
                echo $error;
            }
            elseif (empty($delete_password)) {
                $error ="<p>ぱしゅわーどが無いぉ( ´△｀)</p>";
                echo $error;
            }
            elseif (empty($delete)) {//削除番号が未入力の場合
                $error = "<p>あれっ、何か削除したかったのでは…？(ﾟωﾟ)</p>";
                echo $error;
            }
            else {//削除番号が送信された場合
            
                if (!empty($delete_password)) {
                    $sql = "SELECT * FROM 5_1";//登録済みのデータを抽出
                    $stmt = $pdo -> query($sql);
                    $results = $stmt -> fetchAll();
                    
                    foreach ($results as $row) {
                        
                        if ($row["password"] == $delete_password) {//パスワードが一致する場合
                            $id = $delete;
                            $sql = "delete from 5_1 where id=:id";//番号が一致するデータを削除
                            $stmt = $pdo -> prepare($sql);
                            $stmt -> bindParam(":id", $id, PDO::PARAM_INT);
                            $stmt -> execute();
                        }
                    }
                    
                    echo "<p>削除できたよ！(*^^*)</p>";
                }
            }
        ?>
        
        <hr>
        <p>編集したいコメントの番号を教えてね(´∀｀)</p>
        <form action="" method="post" name="form-edit">
            <input type="number" name="edit" style="height:30px;" placeholder="コメント番号">
            <input type="password" name="edit_password" style="height:30px;" placeholder="パスワード">
            <input type="submit" value="編集♪">
        </form>
        <?php
            if (!empty($delete)) {
                echo "<p>何か編集する？（＾ω＾ ≡ ＾ω＾）</p><hr>";
                
                //既にデータがある場合は表示する
                $sql = "SELECT*FROM 5_1";
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                foreach($results as $row) {
                    echo $row["id"]."　".$row["name"]."　".$row["comment"]."　".$row["date"]."<br>";
                }
            }
            elseif (!isset($edit)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も編集してないよ( ´ ▽ ` )ﾉ</p><hr>";
                echo $error;
                
                //既にデータがある場合は表示する
                $sql = "SELECT*FROM 5_1";
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                foreach($results as $row) {
                    echo $row["id"]."　".$row["name"]."　".$row["comment"]."　".$row["date"]."<br>";
                }
            }
            elseif (!empty($number)) {//投稿フォームで編集対象番号が送信された場合
                echo "<p>編集してほしいなぁ(*^ω^*)</p><hr>";
                
                //既にデータがある場合は表示する
                $sql = "SELECT*FROM 5_1";
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                foreach($results as $row) {
                    echo $row["id"]."　".$row["name"]."　".$row["comment"]."　".$row["date"]."<br>";
                }
            }
            elseif (empty($edit_password)) {//パスワードが未入力の場合
                $error = "<p>ぱ、ぱしゅ…(；ω；)</p><hr>";
                echo $error;
                
                //既にデータがある場合は表示する
                $sql = "SELECT*FROM 5_1";
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                foreach($results as $row) {
                    echo $row["id"]."　".$row["name"]."　".$row["comment"]."　".$row["date"]."<br>";
                }
            }
            elseif (empty($edit)) {//編集番号が未入力の場合
                $error = "<p>何を編集すればヨロシイですか／(^p^)＼</p><hr>";
                echo $error;
                
                //既にデータがある場合は表示する
                $sql = "SELECT*FROM 5_1";
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                foreach($results as $row) {
                    echo $row["id"]."　".$row["name"]."　".$row["comment"]."　".$row["date"]."<br>";
                }
            }
            elseif (!empty($edit_password)) {//パスワードが空でない場合
                echo "<p>編集できるようになったよ！(⌒▽⌒)</p><hr>";
                
                //既にデータがある場合は表示する
                $sql = "SELECT*FROM 5_1";
                $stmt = $pdo -> query($sql);
                $results = $stmt -> fetchAll();
                foreach($results as $row) {
                    echo $row["id"]."　".$row["name"]."　".$row["comment"]."　".$row["date"]."<br>";
                }
            }
        ?>
    </body>
</html>
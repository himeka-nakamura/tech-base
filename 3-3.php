<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>WEB掲示板3</title>
    </head>
    <body>
        <p>名前とコメントを入力してね！(^-^)</p>
        <form action="" method="post" name="form-comment">
            <input type="text" name="name" style="height:30px;" placeholder="名前">
            <input type="text" name="comment" style="height:30px; width:200px;" placeholder="コメント">
            <input type="submit" value="☆送信☆">
        </form>
        
        <?php
            $name = isset($_POST["name"]) ? $_POST["name"] : NULL;
            $comment = isset($_POST["comment"]) ? $_POST["comment"] : NULL;
            $date = date("Y/m/d H:i:s");
            
            if (!isset($comment)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も送信されてないよ(´・∀・｀)</p>";
                echo $error;
            }
            elseif (empty($name) && empty($comment)) {//名前もコメントも未入力の場合
                echo "<p>何でもいいから入力してね(^p^)</p>";
            }
            elseif (empty($name)) {//名前が未入力の場合
                $error = "<p>君の名は？( *｀ω´)</p>";
                echo $error;
            }
            elseif (empty($comment)) {//コメントが未入力の場合
                $error = "<p>コメントも欲しいのである(´･ω･`)</p>";
                echo $error;
            }
            else {//名前もコメントも送信された場合
                $filename = "3-3.txt";
                $fp = fopen($filename, "a");
                $number = count(file($filename));
                $number++;
                fwrite($fp, $number."<>".$name."<>".$comment."<>".$date.PHP_EOL);
                fclose($fp);
                echo "<p>送信できたよ(*^ω^*)</p>";
            }
        ?>
        
        <hr>
        <p>削除したいコメントの番号を教えてね( ；∀；)</p>
        <form action="" method="post" name="form-delete">
            <input type="number" name="delete" style="height:30px;" placeholder="コメント番号">
            <input type="submit" value="削除！">
        </form>
        <?php
            $delete = isset($_POST["delete"]) ? $_POST["delete"] : NULL;
            if (!isset($delete)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も削除してないよ(^-^)</p><hr>";
                echo $error;
                
                $filename = "3-3.txt";
                if (file_exists($filename)) {//既にファイルが存在する場合は中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
            elseif (empty($delete)) {//削除番号が未入力の場合
                $error = "<p>あれっ、何か削除したかったのでは…？(ﾟωﾟ)</p><hr>";
                echo $error;
                
                $filename = "3-3.txt";
                if (file_exists($filename)) {//ファイルの中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
            else {//削除番号が送信された場合
                $filename = "3-3.txt";
                $lines = file($filename, FILE_IGNORE_NEW_LINES);//ファイルを読み込む
                $fp = fopen($filename, "w");//ファイルの書き込み準備および中身を空にする
                
                foreach ($lines as $line) {//ファイルの中身を1行ずつ走査する
                    $info = explode("<>", $line);//行を<>で区切り、データを種類ごとに分ける
                    
                    if ($info[0] != $delete) {//削除番号が行番号と一致しない場合
                        fwrite($fp, $line.PHP_EOL);//行内容をファイルに書き込む
                    }
                }
                
                fclose($fp);//ファイルを閉じる
                echo "<p>削除できたよ！(*^^*)</p><hr>";
                
                $filename = "3-3.txt";
                if (file_exists($filename)) {//ファイルの中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
        ?>
    </body>
</html>
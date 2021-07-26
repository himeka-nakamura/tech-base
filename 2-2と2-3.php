<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>フォームが空のときは？</title>
    </head>
    <body>
        <p>メッセージを送信するぉ＼(^p^)／</p>
        <form action="" method="post">
            <input type="text" name="comment" placeholder="おっ(^p^)">
            <input type="submit" value="☆送信☆">
        </form>
        
        <?php
            $comment = isset($_POST["comment"]) ? $_POST["comment"] : NULL; //フォームが空の時にエラーを起こさないためにはコレが大事らしい
            if (!isset($comment)) { //何もデータを受け取ってない(初めてフォームを開いた)ときの対応
                $error = "<p>まだ何も始まってないぉ(^p^)www</p><hr>";
                echo $error;
            }
            elseif (empty($comment)) { //フォームが空のまま送信された時の反応
                $error = "<p>メッセージが無いと何も表示できないぉ／(^p^)＼</p><hr>";
                echo $error;
            }
            else { //ちゃんとデータが入ってる時の処理
                $filename = "2-2.txt";
                $fp = fopen($filename, "a");
                fwrite($fp, $comment.PHP_EOL);
                fclose($fp);
                
                if (preg_match("/！/", $comment)) { //このif文を「3の倍数ならFizz」とかに書き換える、とか？？？
                    echo "<p>元気でイイ感じだぉ！＼(^p^)／＼(^p^)／＼(^p^)／</p><hr>";
                }
                elseif (preg_match("/？/", $comment)) {
                    echo "<p>どうしたんだぉ？(^p^)</p><hr>";
                }
                else {
                    echo "<p>送信できたぉ☆＼(^p^)／</p><hr>";
                }
                
                if (file_exists($filename)) { //テキストファイルへの書き込み方
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    echo "<p>", $line, "</p>";
                }
                }
            }
        ?>
    </body>
</html>
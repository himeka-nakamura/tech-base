<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Mission2</title>
    </head>
    <body>
        <p>コメントを入力するんだぉ(^p^)</p>
        <form action="" method="post">
            <input type="text" name="comment" value="コメント">
            <input type="submit" value="送信">
        </form>
        
        <?php
            $comment = $_POST["comment"];
            $filename = "2-1.txt";
            $fp = fopen($filename, "a");
            fwrite($fp, $comment.PHP_EOL);
            fclose($fp);
            echo "<p>「", $comment, "」を受け付けたぉ！＼(^o^)／</p><hr>";
            
            if (file_exists($filename)) {
                $lines=file($filename, FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    echo "<p>", $line, "</p>";
                }
            }
        ?>
    </body>
</html>
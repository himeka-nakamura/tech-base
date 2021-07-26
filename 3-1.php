<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>WEB掲示板</title>
    </head>
    <body>
        <p>名前とコメントを入力してね！(^-^)</p>
        <form action="" method="post">
            <input type="text" name="name" style="height:30px;" placeholder="名前">
            <input type="text" name="comment" style="height:30px; width:200px;" placeholder="コメント">
            <input type="submit" value="☆送信☆">
        </form>
        
        <?php
            $name = isset($_POST["name"]) ? $_POST["name"] : NULL;
            $comment = isset($_POST["comment"]) ? $_POST["comment"] : NULL;
            $date = date("Y/m/d H:i:s");
            
            if (!isset($comment)) {
                $error = "<p>まだ何も入力されてないよ(´･ω･`)</p><hr>";
                echo $error;
                
                $filename = "3-1.txt";
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                    echo "<p>", $line, "</p>";
                    }
                }
            }
            else {
                $filename = "3-1.txt";
                $fp = fopen($filename, "a");
                $number = count(file($filename));
                $number++;
                fwrite($fp, $number."<>".$name."<>".$comment."<>".$date.PHP_EOL);
                fclose($fp);
                echo "<p>送信できたよ(*^ω^*)</p><hr>";
                
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                    echo "<p>", $line, "</p>";
                    }
                }
            }
        ?>
    </body>
</html>
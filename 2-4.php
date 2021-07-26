<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>のびしろ〜ず掲示板 by姫河</title>
    </head>
    <body>
        <p>のびしろ〜ず掲示板 by姫河(*´∀`)♪ﾆｬﾊﾊﾉﾊｰﾝ</p>
        <form action="" method="post">
            <input type="text" name="name" placeholder="名前" style="height: 30px;">
            <input type="text" name="comment" placeholder="コメント" style="height:30px; width:200px;">
            <input type="submit" value="☆送信☆">
        </form>
        <?php
            $comment = isset($_POST["comment"]) ? $_POST["comment"] : NULL;
            $name = isset($_POST["name"]) ? $_POST["name"] : NULL;
            $date = date("Y/m/d H:i:s");
            if (!isset($comment)) {
                $error = "<p>コメント待ちNAU⊂( ^ω^ )⊃ﾌﾞｰﾝ</p><hr>";
                echo $error;
                
                $filename = "2-4.txt";
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $lines_r = array_reverse($lines, true);
                    foreach ($lines_r as $line) {
                        echo "<p>", $line, "</p>";
                    }
                }
            }
            elseif (empty($comment) && empty($name)) {
                echo "<p>ちょ、何か書き込んでほしいんだわ( ；∀；)ﾊﾟｵﾝ</p><hr>";
            }
            elseif (empty($comment)) {
                $error = "<p>内容が無いよぅ／(^p^)＼ﾋﾟｴﾝ</p><hr>";
                echo $error;
            }
            elseif (empty($name)) {
                $error = "<p>「君の名は？」状態／(^p^)＼ﾔｯﾁﾏｯﾀﾅｧ</p><hr>";
                echo $error;
            }
            else {
                $filename = "2-4.txt";
                $fp = fopen($filename, "a");
                fwrite($fp, $name."　".$date."<br>".$comment.PHP_EOL);
                fclose($fp);
                
                if (preg_match("/！/", $comment) && preg_match("/？/", $comment)) {
                    echo "<p>エナジー爆発コメントいただきやしたぁーっ！＼(^p^)／ﾄﾞｯｶｰﾝ＼(^p^)／ﾄﾞｯｶｰﾝ＼(^p^)／</p><hr>";
                }
                elseif (preg_match("/！/", $comment)) {
                    echo "<p>元気なコメントせんきゅーぅ！＼(^o^)／ﾜｯｼｮｲ＼(^o^)／ﾜｯｼｮｲ＼(^o^)／</p><hr>";
                }
                elseif (preg_match("/？/", $comment)) {
                    echo "<p>ご質問を検知しました(^o^)bﾁｶﾞｯﾀﾗｺﾞﾒﾝﾖ</p><hr>";
                }
                else {
                    echo "<p>書き込み成功☆＼(^o^)／ﾔｯﾎｲ</p><hr>";
                }
                
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $lines_r = array_reverse($lines, true);
                    foreach ($lines_r as $line) {
                        echo "<p>", $line, "</p>";
                    }
                }
            
            }
        ?>
    </body>
</html>
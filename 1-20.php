<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>フォーム練習</title>
    </head>
    <body>
        <p>何か文字を入力してください！</p>
        <form action="" method="post">
            <input type="text" name="word">
            <input type="submit" value="送信">
        </form>
        <?php
            $word = $_POST["word"];
            echo "<p>", $word, "</p>";
        ?>
    </body>
</html>
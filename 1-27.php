<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Mission1 総集編！</title>
    </head>
    <body>
        <p>好きな数字を入力してくれぉ(^p^)</p>
        <form action="" method="post">
            <input type="text" name="number">
            <input type="submit" value="送信">
        </form>
        <?php
            $number = $_POST["number"];
            $filename = "1-27.txt";
            $fp = fopen($filename, "a");
            fwrite($fp, $number.PHP_EOL);
            fclose($fp);
            echo "<p>ファイルにも書き込み完了だぉ！＼(^p^)／</p>";
            if ($number%3 == 0 && $number%5 == 0) {
                echo "<p>この数字は「FizzBuzz」だぉ！(^p^)</p>";
            }
            elseif ($number%3 == 0) {
                echo "<p>この数字は「Fizz」だぉ☆(^p^)</p>";
            }
            elseif ($number%5 == 0) {
                echo "<p>この数字は「Buzz」だぉ♪(^p^)</p>";
            }
            else {
                echo "<p>コレは「何でもない数」だぉ／(^p^)＼ﾌﾟｷﾞｬｱwww</p>";
            }
            
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    echo "<p>", $line, "</p>";
                }
            }
        ?>
    </body>
</html>
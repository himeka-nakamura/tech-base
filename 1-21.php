<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>フォームFizzBuzz練習</title>
    </head>
    <body>
        <p>好きな数字を入力してください！</p>
        <form action="" method="post">
            <input type="text" name="number">
            <input type="submit" value="送信">
        </form>
        <?php
            $number=$_POST["number"];
            if ($number%3 == 0 && $number%5 == 0) {
                echo "<p>", "FizzBuzz", "</p>";
            }
            elseif ($number%3 == 0) {
                echo "<p>", "Fizz", "</p>";
            }
            elseif ($number%5==0) {
                echo "<p>", "Buzz", "</p>";
            }
            else {
                echo "<p>", $number, "</p>";
            }
        ?>
    </body>
</html>
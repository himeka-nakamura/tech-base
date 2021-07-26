<?php
    $word="おは、こんばんにちは！";
    $filename="1-25.txt";
    $fp=fopen($filename, "w");
    fwrite($fp, $word.PHP_EOL);
    fclose($fp);
    echo "<p>書き込み成功！＼(^p^)／</p>"
?>
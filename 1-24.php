<?php
    $word = "おは、こんばんにちは！＼(^p^)／";
    $filename = "1-24.txt";
    $fp=fopen($filename, "a");
    fwrite($fp, $word.PHP_EOL);
    fclose($fp);
    echo "<p>書き込み成功！</p>";
?>
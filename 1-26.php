<?php
    $word = "復習じゃぁーっ！";
    $filename = "1-26.txt";
    $fp = fopen($filename, "a");
    fwrite($fp, $word.PHP_EOL);
    fclose($fp);
    echo "<p>書き込み成功！＼(^p^)／</p>";
    
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            echo "<p>", $line, "</p>";
        }
    }
?>
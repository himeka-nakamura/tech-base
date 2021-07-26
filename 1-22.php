<?php
    echo "<p>", "買い物リスト！", "</p>";
    $veggies=array("キャベツ", "レタス", "白菜", "ほうれん草", "小松菜");
    foreach ($veggies as $veggy) {
        echo "<p>・", $veggy, "</p>";
    }
?>
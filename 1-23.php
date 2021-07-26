<?php
    $boss = "BOSS";
    $members = array("Ken", "Alice", "Judy", $boss, "Bob");
    foreach ($members as $person) {
        if ($person==$boss) {
            echo "<p>", "Good morning, ", $boss, "!</p>";
        }
        else {
            echo "<p>", "Hi! ", $person, "</p>";
        }
    }
?>
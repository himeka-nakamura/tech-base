<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>WEB掲示板4</title>
    </head>
    <body>
        <?php
            //投稿フォーム
            $number = isset($_POST["number"]) ? $_POST["number"] : NULL;
            $name = isset($_POST["name"]) ? $_POST["name"] : NULL;
            $comment = isset($_POST["comment"]) ? $_POST["comment"] : NULL;
            $date = date("Y/m/d H:i:s");
            $filename = "3-4.txt";
            $edit_number = "";
            $edit_name = "";
            $edit_comment = "";
            if(!empty($_POST["name"]) && !empty($_POST["comment"])){//名前とコメントが空でない場合
                $name = $_POST["name"];
                $comment = $_POST["comment"];
                
                if(!empty($_POST["number"])){//コメント番号が空でない場合
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $number = $_POST["number"];
                    $fp = fopen($filename,"w");
            
                    foreach($lines as $line){
                        $info = explode("<>",$line);//各行のデータを区切り文字で分割
            
                        if($info[0] == $number){//コメント番号と編集対象番号が一致する場合
                            $edited_line = implode("<>", array($number, $name, $comment, $date));
                            fwrite($fp, $edited_line.PHP_EOL);
                        } else{
                            fwrite($fp, $line.PHP_EOL);
                        }
                    }
                    fclose($fp);
                }
                else{//コメント番号が空である場合
                    $filename = "3-4.txt";
                    $fp = fopen($filename, "a");//新規投稿として追加
                    if (file_exists($filename)) {
                        $lines = file($filename, FILE_IGNORE_NEW_LINES);
                        $max = 0;
                        foreach ($lines as $line) {
                            $info = explode("<>", $line);
                            if (intval($info[0]) > $max) {
                                $max = intval($info[0]);
                            }
                        }
                        $number = $max + 1;
                    }
                    else {
                        $number = 1;
                    }
                    // $number = count(file($filename))+1;
                    // $number++;
                    fwrite($fp, $number."<>".$name."<>".$comment."<>".$date.PHP_EOL);
                    fclose($fp);
                }
            }
            
            //削除フォーム
            $delete = isset($_POST["delete"]) ? $_POST["delete"] : NULL;
            
            //編集フォーム
            $edit = isset($_POST["edit"]) ? $_POST["edit"] : NULL;
            if (!empty($edit)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);//ファイルを読み込む
                
                foreach ($lines as $line) {
                    $info = explode("<>", $line);//行ごとにデータを<>で分割
                    
                    if ($info[0] == $edit) {//編集番号が投稿番号と一致する場合
                        //投稿番号・名前・コメントを取得して投稿フォームに表示させる
                        $edit_number = $info[0];
                        $edit_name = $info[1];
                        $edit_comment = $info[2];
                    }
                }
            }
        ?>
        
        <p>名前とコメントを入力してね！(^-^)</p>
        <form action="" method="post" name="form-comment">
            <input type="hidden" name="number" style="height:30px;" placeholder="コメント番号" value="<?php echo $edit_number;?>">
            <input type="text" name="name" style="height:30px;" placeholder="名前" value="<?php echo $edit_name;?>">
            <input type="text" name="comment" style="height:30px; width:200px;" placeholder="コメント" value="<?php echo $edit_comment;?>">
            <input type="submit" value="☆送信☆">
        </form>
        <?php
            if (!empty($delete)) {
                echo "<p>もっと何か書いて〜っ！(ﾉ*>∀<)ﾉ</p>";
            }
            elseif (!empty($edit)) {
                $error = "<p>編集して送信しよう！( ＾∀＾)</p>";
                echo $error;
            }
            elseif (!empty($_POST["name"]) && !empty($_POST["comment"])) {//名前とコメントが空でない場合
                if (!empty($_POST["number"])) {//コメント番号が空でない場合
                        echo "<p>編集できたよ！((o(^∇^)o))</p>";
                }
                else {//コメント番号が空である場合
                    echo "<p>送信できたよ(*^ω^*)</p>";
                }
            }
            elseif (!isset($comment)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も送信されてないよ(´・∀・｀)</p>";
                echo $error;
            }
            elseif (empty($name) && empty($comment)) {//名前もコメントも未入力の場合
                $error = "<p>何でもいいから入力してね(^p^)</p>";
                echo $error;
            }
            elseif (empty($name)) {//名前が未入力の場合
                $error = "<p>君の名は？( *｀ω´)</p>";
                echo $error;
            }
            elseif (empty($comment)) {//コメントが未入力の場合
                $error = "<p>コメントも欲しいのである(´･ω･`)</p>";
                echo $error;
            }
        ?>
        
        <hr>
        <p>削除したいコメントの番号を教えてね( ；∀；)</p>
        <form action="" method="post" name="form-delete">
            <input type="number" name="delete" style="height:30px;" placeholder="コメント番号">
            <input type="submit" value="削除！">
        </form>
        <?php
            if (!isset($delete)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も削除してないよ(*´∀`)♪</p>";
                echo $error;
            }
            elseif (empty($delete)) {//削除番号が未入力の場合
                $error = "<p>あれっ、何か削除したかったのでは…？(ﾟωﾟ)</p>";
                echo $error;
            }
            else {//削除番号が送信された場合
                $lines = file($filename, FILE_IGNORE_NEW_LINES);//ファイルを読み込む
                $fp = fopen($filename, "w");//ファイルの書き込み準備および中身を空にする
                
                foreach ($lines as $line) {//ファイルの中身を1行ずつ走査する
                    $info = explode("<>", $line);//行を<>で区切り、データを種類ごとに分ける
                    
                    if ($info[0] != $delete) {//削除番号が行番号と一致しない場合
                        fwrite($fp, $line.PHP_EOL);//行内容をファイルに書き込む
                    }
                }
                
                fclose($fp);//ファイルを閉じる
                echo "<p>削除できたよ！(*^^*)</p>";
            }
        ?>
        
        <hr>
        <p>編集したいコメントの番号を教えてね(*^ω^*)</p>
        <form action="" method="post" name="form-edit">
            <input type="number" name="edit" style="height:30px;" placeholder="コメント番号">
            <input type="submit" value="編集♪">
        </form>
        <?php
            if (!empty($number)) {//投稿フォームで編集対象番号が送信された場合
                echo "<p>編集してほしいなぁ(*^ω^*)</p><hr>";
                
                if (file_exists($filename)) {//ファイルの中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
            elseif (!empty($delete)) {
                echo "<p>何か編集する？（＾ω＾ ≡ ＾ω＾）</p><hr>";
                
                if (file_exists($filename)) {//既にファイルが存在する場合は中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
            elseif (!isset($edit)) {//何もデータが送信されていない場合
                $error = "<p>まだ何も編集してないよ( ´ ▽ ` )ﾉ</p><hr>";
                echo $error;
                
                if (file_exists($filename)) {//既にファイルが存在する場合は中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
            elseif (empty($edit)) {//編集番号が未入力の場合
                $error = "<p>何を編集すればヨロシイですか／(^p^)＼</p><hr>";
                echo $error;
                
                if (file_exists($filename)) {//ファイルの中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
            else {//編集番号が送信された場合
                $lines = file($filename, FILE_IGNORE_NEW_LINES);//ファイルを読み込む
                
                foreach ($lines as $line) {
                    $info = explode("<>", $line);//行ごとにデータを<>で分割
                    
                    if ($info[0] == $edit) {//編集番号が投稿番号と一致する場合
                        $edit_name = $info[1];//名前を取得
                        $edit_comment = $info[2];//コメントを取得
                    }
                }
                echo "<p>編集できるようになったよ！(⌒▽⌒)</p><hr>";
                
                if (file_exists($filename)) {//ファイルの中身を表示する
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($lines as $line) {
                        $info = explode("<>", $line);
                        echo "<p>", $info[0], "　", $info[1], "　", $info[2], "　", $info[3], "</p>";
                    }
                }
            }
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mission_2-5</title>
    </head>
    <body>
        <h2>投稿フォーム</h2>
        <form action="mission_2-5.php" method="post">
            名前：
            <input type="text" name="name" size="10" maxlength="10"/><br/>
            コメント：
            <input type="text" name="comment" size="50" maxlength="50"/><br/>
            <input type="submit" value="送信"/>
        </form>

        <?php
            if(isset($_POST['comment'])){
                $comment = $_POST['comment'];
            }
            if(isset($_POST['name'])){
                $name = $_POST['name'];
            }

            if($_POST['name'].$_POST['comment'] != ""){
                $fn= 'kadai_2-2.txt';
                $fp = fopen($fn, 'a+');
                $array = file($fn);
                $linenum = count($array)-1;
                if($linenum < 1){
                    $linenum = 1;
                }
                $array_sub = explode("<>", $array[$linenum]);
                $linenum = $array_sub[0]+1;
                $time = date("Y-n-j H:i:s");
                $id = $linenum."<>".$_POST['name']."<>".$_POST['comment']."<>".$time."\n";
                fwrite($fp, $id);
                fclose($fp);
            }
        ?>


        <h2>削除フォーム</h2>
        <form action="mission_2-5.php" method="post">
            削除番号:
            <input type="text" name="delete_num" size="3" maxlength="3"/>
            <input type="submit" value="送信"/>
        </form>
        <?php
            $n = -1;
            if(isset($_POST['delete_num'])){
                $n = $_POST['delete_num'];
            }
            $fn = "kadai_2-2.txt";
            $array = file($fn);
            $l = count($array);
            if($n >= 0){
                $fp = fopen($fn, 'w+');
                for($i = 0; $i < $l; $i++){
                    $array_sub = explode("<>", $array[$i]);
                    $t = $array_sub[0];
                    if($t != $n){
                        fwrite($fp, $array[$i]);
                    }
                }
                fclose($fp);
            }
        ?>


        <h2>編集フォーム</h2>
        <form action="mission_2-5.php" method="post">
            編集番号：
            <input type="text" name="edit_num" size="3" maxlength="3"/><br/>
            <input type="submit" value="編集"/>
        </form>
        
        <?php
            if(!empty($_POST['edit_num'])){
                $n = $_POST['edit_num'];
            }

            $fn = "kadai_2-2.txt";
            $array = file($fn);
            $l = count($array);

            if($n >= 0){
                $key = -1;
                for($i = 0; $i < $l; $i++){
                    $array_sub = explode("<>", $array[$i]);
                    if($n == $array_sub[0]){
                        $key = $i;
                        $edit_name = $array_sub[1];
                        $edit_comment = $array_sub[2];
                    }
                }
            }

            if($key < 0 && $n > 0){
                echo "正しい編集番号を選択してください。<br/>\n";
            }else{
                echo "<form action=\"mission_2-5.php\" method=\"post\">
                        投稿番号：
                        <input type=\"text\" name=\"en\" size=\"3\" maxlength=\"3\" value=\"{$n}\" /> 番号は変えないでください！<br/>
                        名前：
                        <input type=\"text\" name=\"new_name\" size=\"10\" maxlength=\"10\" value=\"{$edit_name}\" /><br/>
                        コメント：
                        <input type=\"text\" name=\"new_comment\" size=\"50\" maxlength=\"50\" value=\"{$edit_comment}\" /><br/>
                        <input type=\"submit\" value=\"送信\"/>
                    </form>";
                for($i = 0; $i < $l; $i++){
                    $array_sub = explode("<>", $array[$i]);
                    if($array_sub[0] == $_POST['en']){
                        $new_line = $_POST['en']."<>".$_POST['new_name']."<>".$_POST['new_comment']."<>".date("Y-n-j H:i:s")."\n";
                        $array[$i] = $new_line; 
                    }
                }

                $fp = fopen($fn, 'w+');
                for($i = 0; $i < $l; $i++){
                    fwrite($fp, $array[$i]);
                }
                fclose($fp);
            }
        ?>

        <h1>簡易掲示板</h1>
        <?php
            $fn = "kadai_2-2.txt";
            $array = file($fn);
            for($i = 0; $i < count($array); $i++){
                $array_sub = explode("<>", $array[$i]);
                echo "<HR>";
                echo "投稿番号".$array_sub[0]."  ||  ".$array_sub[3]."<br/>\n";
                echo "投稿者".$array_sub[1]." : ".$array_sub[2]."<br/>\n";
            }
        ?>
        <HR>
    </body>
</html>
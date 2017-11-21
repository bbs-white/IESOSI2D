<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mission_2-1</title>
    </head>
    <body>
        <h1>名前とコメントを入力する。</h1>
        <form action="mission_2-1.php" method="post">
            名前：<br/>
            <input type="text" name="name" size="10" maxlength="10"/><br/>
            コメント：<br/>
            <input type="text" name="comment" size="50" maxlength="50"/><br/>
            <input type="submit" value="送信"/>
            <HR>
        </form>

        <?php
            if(isset($_POST['comment'])){
                $comment = $_POST['comment'];
            }
            if(isset($_POST['name'])){
                $name = $_POST['name'];
            }
            if($comment.$name == ""){
                echo "何も入力されていません！<br/>\n";
            }else{
                echo "入力された名前：". $name ."<br/>\n";
                echo "入力されたコメント：". $comment ."<br/>\n";
            }
        ?>
    </body>
</html>
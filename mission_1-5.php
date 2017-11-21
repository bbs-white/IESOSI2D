<?php

if(isset($_GET['comment'])){
    $id = $_GET['comment'];
    $filename = 'kadai5.txt';
    $fp = fopen($filename, 'w');
    fwrite($fp, $id);
    fclose($fp);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Mission_1-5</title>
</head>
<body>
    <h1>フォームデータの送信</h1>
    <form action="mission_1-5.php" method="get">
        <input type="text" name="comment"><br/>
        <input type="submit" value="送信">
    </form>
</body>
</html>

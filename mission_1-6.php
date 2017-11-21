<?php

if(isset($_GET['comment'])){
    $filename = 'kadai6.txt';
    $id = file_get_contents($filename);
    $id .= $_GET['comment'];
    $fp = fopen($filename, 'w');
    fwrite($fp, $id."\n");
    fclose($fp);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Mission_1-6</title>
</head>
<body>
    <h1>フォームデータの送信</h1>
    <form action="mission_1-6.php" method="get">
        <input type="text" name="comment"><br/>
        <input type="submit" value="送信">
    </form>
</body>
</html>

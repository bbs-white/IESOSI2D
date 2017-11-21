<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Mission_2-3</title>
	</head>
	<h1>名前とコメントを入力する。</h1>
	<form action="mission_2-3.php" method="post">
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
		if($_POST['name'].$_POST['comment'] == ""){
			echo "名前とコメントが入力されていません！<br/>\n";
		}else{
			$fn= 'kadai_2-2.txt';
			$array = file($fn);
			$linenum = count($array)-1;
			if($linenum < 1){
				$linenum = 1;
			}
			$array_sub = explode("<>", $array[$linenum]);
			$linenum = $array_sub[0]+1;
			$time = date("Y-n-j H:i:s");
			$id = $linenum."<>".$_POST['name']."<>".$_POST['comment']."<>".$time."\n";
			$fp = fopen($fn, 'a+');
			fwrite($fp, $id);
			fclose($fp);
		}
	?>
	<h1>簡易掲示板</h1>
	<?php
		$fn = 'kadai_2-2.txt';
		$array = file($fn);
		for($i = 0; $i < count($array); $i++){
			$array_sub = explode("<>", $array[$i]);
			echo "<HR>";
			echo "投稿番号".$array_sub[0]."  ||  ".$array_sub[3]."<br/>\n";
			echo "投稿者".$array_sub[1]." | コメント：".$array_sub[2]."<br/>\n";
		}
	?>
	<HR>
</html>
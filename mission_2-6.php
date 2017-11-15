<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Mission_2-6</title>
	</head>
	<body>
		<h2>投稿フォーム</h2>
		<form action="mission_2-6.php" method="post">
			名前：
			<input type="text" name="name" size="10" maxlength="10"/><br/>
			コメント：
			<input type="text" name="comment" size="50" maxlength="50"/><br/>
			パスワード：(5文字以内)
			<input type="text" name="ps" size="5" maxlength="5" /><br/>
			<input type="submit" value="送信"/>
		</form>

		<?php
			$fn = "kadai_2-6.txt";
			if($_POST['name'].$_POST['comment'] != ""){
				$fp = fopen($fn, 'a+');
				$array = file($fn);
				$linenum = count($array)-1;
				$array_sub = explode("<>", $array[$linenum]);
				$x = $array_sub[0]+1;
				$time = date("Y-n-j H:i:s");
				$id = $x."<>".$_POST['name']."<>".$_POST['comment']."<>".$time."<>".$_POST['ps']."<>\n";
				fwrite($fp, $id);
				fclose($fp);
			}
		?>


		<h2>削除フォーム</h2>
		<form action="mission_2-6.php" method="post">
			削除番号:
			<input type="text" name="delete_num" size="3" maxlength="3"/><br/>
			パスワード:
			<input type="text" name="delete_ps" size="5" maxlength="5" /><br/>
			<input type="submit" value="送信"/>
		</form>
		<?php
			if(isset($_POST['delete_num'])){
				$d_num = $_POST['delete_num'];
			}
			if(isset($_POST['delete_ps'])){
				$d_ps = $_POST['delete_ps'];
			}
			if($d_num > 0){
				$array = file($fn);
				$l = count($array);
				$fp = fopen($fn, 'w+');
				for($i = 0; $i < $l; $i++){
					$array_sub = explode("<>", $array[$i]);
					if($d_num == $array_sub[0]){
						if($d_ps == $array_sub[4]){
							continue;
						}else{
							echo "パスワードが違うので削除できません。";
							fwrite($fp, $array[$i]);
						}
					}else{
						fwrite($fp, $array[$i]);
					}
				}
				fclose($fp);
			}
		?>


		<h2>編集フォーム</h2>
		<form action="mission_2-6.php" method="post">
			編集番号：
			<input type="text" name="edit_num" size="3" maxlength="3"/><br/>
			<input type="submit" value="編集"/>
		</form>
		
		<?php
			if(!empty($_POST['edit_num'])){
				$n = $_POST['edit_num'];
			}

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
				echo "<form action=\"mission_2-6.php\" method=\"post\">
						投稿番号：
						<input type=\"hidden\" name=\"en\" size=\"3\" maxlength=\"3\" value=\"{$n}\" /><br/>
						名前：
						<input type=\"text\" name=\"new_name\" size=\"10\" maxlength=\"10\" value=\"{$edit_name}\" /><br/>
						コメント：
						<input type=\"text\" name=\"new_comment\" size=\"50\" maxlength=\"50\" value=\"{$edit_comment}\" /><br/>
						パスワード：
						<input type=\"text\" name=\"e_ps\" size=\"5\" maxlength=\"5\"/><br/>
						<input type=\"submit\" value=\"送信\"/>
					</form>";
				for($i = 0; $i < $l; $i++){
					$array_sub = explode("<>", $array[$i]);
					if($array_sub[0] == $_POST['en'] && $array_sub[4] == $_POST['e_ps']){
						$new_line = $_POST['en']."<>".$_POST['new_name']."<>".$_POST['new_comment']."<>".date("Y-n-j H:i:s")."<>".$_POST['e_ps']."<>\n";
						$array[$i] = $new_line; 
					}else if($array_sub[0] == $_POST['en'] && $array_sub[4] != $_POST['e_ps']){
						echo "パスワードが違うので編集できません。<br/>";
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
			$array = file($fn);
			for($i = 0; $i < count($array); $i++){
				$array_sub = explode("<>", $array[$i]);
				$num = $array_sub[0];
				$owner = $array_sub[1];
				$ti = $array_sub[3];
				$c = $array_sub[2];
				echo "<HR>";
				echo "投稿番号 {$num} ||  {$ti}<br/>";
				echo "投稿者 {$owner} : {$c}<br/>";
			}
		?>
		<HR>
	</body>
</html>
<?php
require_once("model/Message.php");
$obj = new Message();
$conErr = $obj->connect();
if (!empty($conErr)) { echo $conErr; die();}

if (!empty($_POST['regist'])){
    $ret =$obj->put_msg();
}

$obj->close();
?>
<html>
<meta http-equiv="Content-Type"; content="text/html; charset=UTF-8">
<body>
<form method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>">
|メッセージコード<br>
<input type="input" name="msgcd" value="1">
<input type="input" name="biko" value="">

<br><br><br>

|メッセージ種類<br>
<input type="radio" name="msgkb" value="1" checked>通常<br>
<input type="radio" name="msgkb" value="2">警告<br>
<input type="radio" name="msgkb" value="3">エラー<br>
<br>
|メッセージ内容<br>
 <textarea id="msg" style="width:80%;height:50%" name="msg"></textarea><br>
<input type="submit" name="regist" value="送信する" id="regist">
</form>


</body>
</html>

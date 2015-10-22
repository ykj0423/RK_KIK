<?php
@session_start();

require_once("model/Kyaku.php");
$ini = parse_ini_file('model/config.ini');
$sysname = $ini['SYSTEM_NAME'];
$centername = $ini['CENTER_NAME'];

$obj = new Kyaku();
$conErr = $obj->connect();
if (!empty($conErr)) { echo $conErr; die();}

if (!isset($_SESSION['webrk']['user'])) {
    //ログイン画面へ飛ばす
    header('location: login.php ');
    exit();
}

$step = 'input';
$user=$_SESSION['webrk']['user'];

if (!empty($_POST['confirm']) || !empty($_POST['regist'])){
    $ret = $obj->Edit();
    $errmsg = $ret['ErrMsg'];
    $step = $ret['step'];

}

$obj->close();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>利用者情報管理 | <?php echo $sysname; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<p id="head_center"><?php echo $centername; ?></p>
<div class="page-header">
<h1>利用者情報管理　<small><?php echo $sysname; ?></small></h1>
</div>

<ul class="nav nav-tabs nav-menu">
<li><a href="top.php">トップ</a></li>
<li><a href="search.php" >空き状況/予約申込</a></li>
<li><a href="rsvlist.php">予約照会</a></li>

<li><a class="dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-expanded="false" >利用者情報管理<span class="caret"></span></a>
<ul id="subul" class="dropdown-menu" role="menu"><li><a href="member.php">メールアドレスの変更・メール受信テスト</a></li><li><a href="pass.php">パスワードの変更</a></li></ul>
</li>
<li><a href="help.php" target="_blank">システムガイド</a></li>
<li><a href="login.php" >ログアウト</a></li>
</ul>
	<h4>ユーザ情報の変更</h4>
<?php
if ($errmsg) {
  $code = '<span style="font-size:120%;padding-left:15px;padding-right:15px;background:red;margin-bottom:10px">'.$errmsg.'　</span>';
  echo $code;
}
?>

<?php if ($step == 'input' ) { ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table  class="srchbox mb10" width="80%">
	<tbody>
	<tr><th width="30%">団体名</th><td><?php echo $user['dannm']; ?></td></tr>
	<tr><th width="30%">メールアドレス<span class="red">(必須)</span></th><td><input type="test" name="mail" value="<?php echo $mail; ?>"></td></tr>
	<tr><th width="30%">現在のパスワード<span class="red">(必須)</span></th><td><input type="password" name="pwd" value="<?php echo $pwd; ?>"></td></tr>
	<tr><th>新しいパスワード<span class="red">(必須)</span></th><td><input type="password" name="passnew" value=""></td></tr>
	<tr><th>新しいパスワード（再入力）<span class="red">(必須)</span></th><td><input type="password" name="passnew2" value=""></td></tr>	     </tbody>
	</table>
	<input type="submit" class="btn btn-warning " name="confirm" role="button" value="確認画面へ　>>">
</form>


<?php }else if ($step == 'confirm' ) { ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table  class="srchbox mb10" width="80%">
	<tbody>
	<tr><th width="30%">団体名</th><td><?php echo $user['dannm']; ?></td></tr>
	<tr><th width="30%">メールアドレス<span class="red">(必須)</span></th><td><?php echo $mail; ?></td></tr>
	</tbody>
	</table>
    <input type="hidden" name="pwd" value="<?php echo $pwd; ?>">
    <input type="hidden" name="passnew" value="<?php echo $passnew; ?>">
    <input type="hidden" name="passnew2" value="<?php echo $passnew2; ?>">
    <input type="hidden" name="mail" value="<?php echo $mail; ?>">
    戻るボタン必要
	<input type="submit" class="btn btn-warning " name="regist" role="button" value="送信するへ　>>">
</form>
<?php }else if ($step == 'finish' ) { ?>
    変更しました
<?php } ?>

	<br>
	<br>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>



</body>
</html>
<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ログインID/パスワードの確認と再発行 | <?php echo $_SESSION['webrk']['sysname']; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<p id="head-center-warning"><?php echo $_SESSION['webrk']['centername']; ?></p>
<div class="page-header">
<h1>ログインID/パスワードの確認と再発行　<small><?php echo $_SESSION['webrk']['sysname']; ?>/small></h1>
</div>

<h3>ログインIDの確認</h3>
<p>必要事項をご記入のうえ、送信ボタンを押してください。
   <br>ご登録内容と照会して、下記のアドレス宛にログインIDをお送りいたします。
   <br>※迷惑メール対策をされている方は、事前に『xxxx.xx.xx』を受信許可ドメインとしてご設定ください。
</p>
<table class="custom mb10 mw1000">
<tbody>
<tr><th><span class="red">WEB利用登録された</span>メールアドレス<span class="red note">(必須)</span></th><td><input type="text" name="email" value="" style="width:300px">(半角英数字)  </td></tr>
<tr>
	<td colspan="2" align="center">
		<a class="btn btn-default " href="top.php" role="button">戻る</a>
		<a class="btn btn-warning " href="remainder_end.php" role="button">送信する　>></a>

</td></tr>
</tbody>
</table>

<hr>
<h3>パスワードの再発行</h3>
<p>必要事項をご記入のうえ、送信ボタンを押してください。
   <br>ご登録内容と照会して、下記のアドレス宛にパスワード再発行のURLをお送りいたします。
   <br>※迷惑メール対策をされている方は、事前に『xxxx.xx.xx』を受信許可ドメインとしてご設定ください。
</p>
<table class="custom mb10 mw1000">
<tbody>
<tr>
	<th>ログインID<span class="red note">(必須)</span></th>
	<td><input type="text" name="loginid" value="" ></td>
</tr>
<tr>
	<th>代表者の連絡先電話番号<span class="red note">(必須)</span></th>
	<td>	
	    <input type="text" name="tel1">
	</td>
</tr>
<tr>
	<th><span class="red">WEB利用登録された</span>メールアドレス<span class="red note">(必須)</span></th>
	<td><input type="text" name="email" value="" style="width:300px">(半角英数字)  </td>
</tr>
<tr>
	<td colspan="2" align="center">
		<a class="btn btn-default " href="top.php" role="button">戻る</a>
		<a class="btn btn-warning " href="remainder_end.php" role="button">送信する　>></a>

</td></tr>
</tbody>
</table>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
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
<title>確認メールの送信完了 |  <?php echo $_SESSION['webrk']['sysname']; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<p id="head-center-warning"><?php echo $_SESSION['webrk']['centername']; ?></p>
<div class="page-header">
<h1>確認メールの送信完了　<small><?php echo $_SESSION['webrk']['sysname']; ?></small></h1>
</div>

<p>以下のアドレスにメールが到着していることを確認してください。<br>
メールの到着が確認できない場合はお使いのメールソフトの迷惑メールBOXに振分けされている可能性がありますのでご確認下さい。
</p>

<div class="alert alert-warning" role="alert">xxx@xxx.com</div>

<br>

<p>※ご注意　パスワードを再発行された方へ※</p>
<ul>
<li>セキュリティ保護のため、メールに記載されたURLは1時間で無効になります</li>
<li>有効期限切れの場合、再度再発行の手続きを行ってください。</li>
<li>パスワードは他人に知られないようにお取扱いを慎重にお願いいたします。<br>パスワードは定期的に変更されることをお勧めします。</li>
</li>
</ul>

<a class="btn btn-default " href="login.php" role="button">ログイン画面へ</a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
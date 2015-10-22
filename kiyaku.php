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
<title>施設利用規約 | <?php echo $_SESSION['webrk']['sysname']; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="container">
  <p class="bg-head text-right"><?php echo $_SESSION['webrk']['centername']; ?></p>
  <h1><span class="midashi">|</span>施設利用規約 　<small><?php echo $_SESSION['webrk']['sysname']; ?></small></h1>


  <div class="panel  panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title">申込みに際しては以下に同意して頂く必要があります</h3>
        </div>
        <div class="panel-body">
  	<dl>
  		<dt>第1条</dt>
  		<dd>XXXXXXXXXXXXXXXXXXXXXXXXXXXX</dd>
  		<dt>第2条</dt>
  		<dd>XXXXXXXXXXXXXXXXXXXXXXXXXXXX</dd>
  		<dt>第3条</dt>
  		<dd>XXXXXXXXXXXXXXXXXXXXXXXXXXXX</dd>
  		<dt>第4条</dt>
  		<dd>XXXXXXXXXXXXXXXXXXXXXXXXXXXX</dd>
  		<dt>第5条</dt>
  		<dd>XXXXXXXXXXXXXXXXXXXXXXXXXXXX</dd>
  		<dd>XXXXXXXXXXXXXXXXXXXXXXXXXXXX</dd>
  	</dl>
        </div>
  </div>
  
  <div class="form-group">
    <input type="checkbox" name="agree" id="agree" value="1"><label for="agree">利用規約を承認します</label>
  </div>
  <a class="btn btn-default btn-lg" href="login.php" role="button">戻る</a>
  <a href="search.php"><input type="submit" value="次へ" class="btn btn-warning btn-lg"></a>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
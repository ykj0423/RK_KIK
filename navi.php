<p class="bg-head text-right"><?php echo $_SESSION['webrk']['sysname']; ?>　<?php echo $_SESSION['webrk']['centername']; ?></p>
  <nav class="navbar nav-custom">
    <div class="container-fluid">
        <div class="nav-header">
           <a href="top.php" class="navbar-brand">トップ</a>
         </div>
         <ul class="nav navbar-nav">
            <li><a href="search.php">空き状況検索</a></li>
<?php //if (isset($_SESSION['webrk']['user'])){ ?>
            <li><a href="rsvlist.php">予約照会</a></li>

            <li  class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">利用者情報管理<span class="caret"></span></a>
                <ul id="subul" class="dropdown-menu text-left" role="menu"><li><a href="member.php">メールアドレスの変更・メール受信テスト</a></li><li><a href="pass.php">パスワードの変更</a></li></ul>
            </li>
<?php //} ?>
            <li><a href="http://www.kobe-kinrou.jp/shisetsu/kinroukaikan/ryokin.php#h3473" target="_blank">料金表</a></li>
            <li><a href="help.php" target="_blank">システムガイド</a></li>

         </ul>
<?php //if (isset($_SESSION['webrk']['user'])){ ?>
         <form name="fuser" class="navbar-form pull-right" method="post" action="logout.php">
            <button type="button" class="btn btn-logout dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <?php echo mb_convert_encoding( $_SESSION['webrk']['user']['dannm'], "utf8", "sjis" ); ?>様　ログイン中 <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="javascript:void(0)" class="logout" onclick="document.fuser.submit();return false;">ログアウト</a></li>
            </ul>
         </form>
<?php //} ?>
   </div>
  </nav>
    <!-- ここまでメニュー -->

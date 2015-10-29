<?php
@session_start();

$errmsg = "";
//header
$pageTitle = "新規利用者登録[確認]";
include('include/header.php');
include('model/Kyaku2.php');

/**
 * ReserveKeeperWeb予約システム
 *
 * PHP versions 4
 *
 * @category   公益財団法人神戸いきいき勤労財団／新規利用者登録[確認]
 * @package    none
 * @author     y.kamijo <y.kamijo@gandg.co.jp>
 * @copyright  2015 G&G Co.ltd.
 * @license    G&G Co.ltd.
 * @version    0.1
**/


if( isset( $_POST['submit'] ) && !empty( $_POST['submit'] ) ){

    if ( !$errmsg ) {
        header( 'location: regist_end.php' );
        exit();
    }

}

$Kyaku = unserialize( $_SESSION['Kyaku'] );

//エラーメッセージ
include('include/err.php');
include('navi.php');

?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script src="js/custom.js"></script>
</head>
<body>
    <p>入力内容をご確認いただき、問題がなければ「送信する」ボタンを押してください。</p>
      <table id="demo" align="center" class="table table-bordered table-condensed  form-inline f120" >
      <tr>
        <th>団体名</th>
        <td><?php echo  $Kyaku->put_data('dannm'); ?></td>
      </tr>
      <!--tr>
        <th>利用者名（カナ）</th>
        <td><?php //echo  $Kyaku->put_data('dannmk'); ?></td>
      </tr-->
      <tr>
        <th>住所</th>
        <td>
          〒651-0086<br>
          <?php echo $Kyaku->put_data('adr1'); ?>
        </td>
      </tr>
      <tr>
        <th>代表者名</th>
        <td><?php echo $Kyaku->put_data('daihyo'); ?></td>
      </tr>
      <tr>
        <th >代表者TEL</th>
        <td><?php echo $Kyaku->put_data('tel1_1'); ?>-<?php echo $Kyaku->put_data('tel1_2'); ?>-<?php echo $Kyaku->put_data('tel1_3'); ?></td>
      </tr>
      <tr>
        <th>代表者メールアドレス</th>
        <td><?php echo $Kyaku->put_data('mail'); ?></td>
      </tr>
      <tr>
        <th>連絡者名</th>
        <td><?php echo $Kyaku->put_data('renraku'); ?></td>
      </tr>
      <tr>
        <th >連絡者TEL</th>
        <td><?php echo $Kyaku->put_data('tel2_1'); ?>-<?php echo $Kyaku->put_data('tel2_2'); ?>-<?php echo $Kyaku->put_data('tel2_3'); ?></td>
      </tr>
      <tr>
        <th>連絡者メールアドレス</th>
        <td><?php echo $Kyaku->put_data('mail'); ?></td>
      </tr>      <tr>
        <th>FAX</th>
        <td><?php echo $Kyaku->put_data('fax_1'); ?>-<?php echo $Kyaku->put_data('fax_2'); ?>-<?php echo $Kyaku->put_data('fax_3'); ?></td>
      </tr>

      <!--tr>
        <th>業種</th>
        <td>サービス業</td>
      </tr>
      <tr>
        <th>資本金または元入金</th>
        <td><?php //echo $Kyaku->put_data('sihon'); ?>万円</td>
      </tr>
      <tr>
        <th>従業員数</th>
        <td><?php //echo $Kyaku->put_data('jygsu'); ?>名</td>
      </tr-->
    </table>

    <?php  //$_SESSION['Kyaku'] = serialize( $Kyaku );?>
    <div style="text-align:center">
      <a class="btn btn-default btn-lg mb20" href="regist.html" role="button"><< 修正する</a>
      <a class="btn btn-primary btn-lg mb20" href="regist_end.php" role="button">送信する　>></a>
    </div>
 </div>
</body>
</html>

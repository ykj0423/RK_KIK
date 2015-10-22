<?php echo "a"; ?><?php @session_start(); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW,NOARCHIVE">
<title>予約申込み[完了]　 |  <?php echo $_SESSION['webrk']['sysname']; ?></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script src="js/custom.js"></script>
</head>
<script>
jQuery(function () {
    //HTMLを初期化  
    $("table.rsv_input tbody.list").html("");
    var objData = JSON.parse(localStorage.getItem("sentaku"));
    for (var i=0; i<objData.length; i++){
        var tr = $("<tr></tr>");
        var td1 = $("<td></td>");
        var td2 = $("<td></td>");
        var td3 = $("<td></td>");
        var td4 = $("<td></td>");
        var td5 = $("<td></td>");
        $("#list").append(tr);
        tr.append(td1).append(td2).append(td3).append(td4).append(td5);
        td1.html(i + 1);
        td2.html(objData[i]['usedt']);
        td3.html(objData[i]['jkn1'] + "～"+ objData[i]['jkn2']);
        td4.html(objData[i]['rmnm']);
    } 	
});
</script>
<body class="container">
<?php echo "test2";
include("navi.php"); ?>

<!------------------->
   <div class="row">
      	<div class="col-xs-6" style="padding:0">
        <h1><span class="midashi">|</span>予約申込み[完了]</h1>
       </div>

      	<div class="col-xs-6  text-right">
          <span class="f120">現在の時間：　<span id="currentTime"></span></span>
       </div>
   </div>
<!------------------->

<!-- main -->
	<h4>ご予約のお申込を受け付けました。</h4>
	<p class="red">※ご注意※　施設利用料のお支払が完了するまで、予約は確定していません。</p>
	<p>
		以下の内容でお申込みを受け付けましたが、先着順となりますのでご希望通りに受理できない可能性がございます。<br>
		ご予約結果については、<a href="rsvlist.php">予約照会画面</a>にてご確認下さい。<br>
		なお、下記のアドレス宛にご予約結果のメールを送信しておりますので、ご確認をお願いします。
	</p>
	<br>
	<div class="alert alert-warning" role="alert">
		WEB受付番号：  <span style="font-size:1.2em">XXXX-XXXX</span></div>

 <table id ="rsv_input" class="table table-bordered table-condensed  form-inline">
<tbody id="list"> <tr>
    		        <td>サンプル</td>
    		        <td>2014/11/27（木）</td>
    		        <td>09:00～12:00</td>
    		        <td>会議室A  </td>
    	        </tr></tbody>
</table>
	<a class="btn btn-default btn-lg" href="top.php" role="button">トップページに戻る</a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?php
echo "test2";
$serverName = "ITWEB1";
$connectionInfo = array( "Database"=>"RK_KIK_DB1", "UID"=>"sa", "PWD"=>"" );
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$usedt = 20150820;
$rmcd = 11;
$timekb = 1;

//$sql = "SELECT * FROM ks_jkntai　WHERE usedt = ".$usedt." AND rmcd = ".$rmcd ." AND timekb = ".$timekb;
//echo $sql;
//$params = array();
//$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
//$stmt = sqlsrv_query( $conn, $sql, $params);

//$row_count = sqlsrv_num_rows( $stmt );
   
/*if ($row_count === false){
	echo "Error in retrieveing row count.";
}else{
	echo "row_count = ".$row_count;
	die();
}*/

$sql = "INSERT INTO ks_jkntai (usedt , jikan , rmcd , timekb , ukeno , gyo , login , udate , utime)  VALUES  (?,? ,?,?,?,?,? ,?,?)";
//PK usedt , jikan , rmcd , timekb 

//1時間め
$params = array(20150820, 9,111,1,15000016,1,'webtest',date("Ymd") , date("His"));
//※受付ナンバー

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".mb_convert_encoding( $error[ 'message'] ,  "UTF-8" )."<br />";
			die();
        }
    }
}


//2時間め
$params = array(20150820, 10,111,1,15000016,1,'webtest',date("Ymd") , date("His"));

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

//3時間め
$params = array(20150820, 11,111,1,15000016,1,'webtest',date("Ymd") , date("His"));

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}*/

echo "dt_roomr";

//$sql = "INSERT INTO dt_roomr (ukeno , ukedt , nen , krkb , krmemo , ukecd , nyutncd , ukehkb , kyacd , dannm , dannm2 , dannmk , daihyo , renraku , tel1 , tel2 , fax ,zipcd ,adr1, adr2 , gyscd , sihon,  jygsu , kaigi , kaigir , naiyo , kbiko ,  kupdkb , rsbkb ,  riyokb , login , udate ,utime )  VALUES  (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$sql = "INSERT INTO dt_roomr (ukeno , ukedt , nen , krkb , krmemo , ukecd , nyutncd , ukehkb , kyacd , dannm , dannm2 , dannmk , daihyo , renraku , tel1, tel2 , fax , zipcd , adr1,adr2 , gyscd , sihon , jygsu , kyakb , kaigi , kaigir , naiyo , kbiko , kupdkb , rsbkb , riyokb , login , udate,utime)  VALUES (? , ? , ? , ? , ? , ? , ?, ? , ? , ? , ? , ? , ? , ? , ?, ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?, ?,?)"; 

//$sql =              ukeno ,     ukedt ,      nen , krkb , krmemo , ukecd , nyutncd , ukehkb , kyacd , dannm , dannm2 , dannmk , daihyo , renraku ,                    tel1, tel2 , fax , zipcd , adr1,adr2 ,                                                                                       gyscd , sihon , jygsu , kyakb , kaigi , kaigir , naiyo , kbiko , kupdkb , rsbkb , riyokb , login , udate,utime)  
$params = array(15000016, 20150820, 2015, 0       , "",       1,          1,          1,         10,     "だんたい","だんたい２","カナ","代表者名","連絡者名","0120222221","0120222222","0120222223","655-0023","兵庫県神戸市垂水区清水通","●×ビル5-202",1,0,0,1,"会議名称","会議名称","会議内容","",0,1,2,'webtest',date("Ymd") , date("His"));

/*$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
             echo "message: ".mb_convert_encoding( $error[ 'message'] ,  "UTF-8" )."<br />";
			die();
        }
    }
}*/
echo "dt_roomrmei";

//$sql = "INSERT INTO dt_roomrmei(ukeno  ,gyo  ,rmcd  ,kyono  ,kyodt  ,usedt  ,yobi  ,yobikb  ,timekb  ,stjkn  ,edjkn  ,hbstjkn  ,hbedjkn  ,ratekb  ,ratesb  ,zgrt  ,ninzu  ,rmtnk  ,rmentnk  ,rmtukin  ,rmenkin  ,rmkin  ,hzkin  ,rmnykin  ,hznykin  ,synykin  ,candt  ,cankb  ,hkktdt  ,hkdt  ,hkkin  ,kskbn  ,biko  ,tag1  ,tag2  ,tag3  ,login  ,udate  ,utime)
 //    VALUES  (?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?  ,?)";

	 $yobi = mb_convert_encoding("木" , "SJIS","UTF-8");

//$yobi = mb_convert_encoding("木" , "UTF-8","SJIS");
$sql = "INSERT INTO dt_roomrmei(ukeno  ,gyo  ,rmcd  ,kyono  ,kyodt  ,usedt  ,yobi  ,yobikb  ,timekb  ,stjkn  ,edjkn  ,hbstjkn  ,hbedjkn  ,ratekb  ,ratesb  ,zgrt  ,ninzu  ,rmtnk  ,rmentnk  ,rmtukin  ,rmenkin  ,rmkin  ,hzkin  ,rmnykin  ,hznykin  ,synykin  ,candt  ,cankb  ,hkktdt  ,hkdt  ,hkkin  ,kskbn  ,biko  ,tag1  ,tag2  ,tag3  ,login  ,udate  ,utime)
     VALUES  (15000016,1,11,0,0,20150820,".$yobi.", 3, 1, 900,  1200, 900, 1200 ,  1,0, 100, 0,  4800 , 0 , 4800 ,0 , 4800 ,  0,  4800, 0 ,0 , 0,  0, 0,0,0,0,N'',0,0,0,'webtest',".date('Ymd') .", ".date('His').")";

echo $sql;
	 $params = array();
	 //$sql = "INSERT INTO dbo.dt_roomrmei(ukeno  ,gyo  ,rmcd  ,kyono  ,kyodt  ,usedt  ,yobi  ,yobikb  ,timekb  ,stjkn  ,edjkn  ,hbstjkn  ,hbedjkn  ,ratekb  ,ratesb  ,zgrt  ,ninzu  ,rmtnk  ,rmentnk  ,rmtukin  ,rmenkin  ,rmkin  ,hzkin  ,rmnykin  ,hznykin  ,synykin  ,candt  ,cankb  ,hkktdt  ,hkdt  ,hkkin  ,kskbn  ,biko  ,tag1  ,tag2  ,tag3  ,login  ,udate  ,utime)
//$sql = "insert into testTable01 values (1,N'あああああ',N'いいいい');";
//$params = array(15000016,1,11,0,0,20150820,N'木', 3, 1, 900,  1200, 900, 1200 ,  1,0, 100, 0,  4800 , 0 , 4800 ,0 , 4800 ,  0,  4800, 0 ,0 , 0,  0, 0,0,0,0,"",0,0,0,'webtest',date("Ymd") , date("His"));

$stmt = sqlsrv_query( $conn, $sql, $params);

if( $stmt === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
             echo "message: ".mb_convert_encoding( $error[ 'message'] ,  "UTF-8" )."<br />";
			die();
        }
    }
}

/* INSERT INTO [dbo].[dt_roomr]
           ([ukeno]
           ,[ukedt]
           ,[nen]
           ,[krkb]//仮予約区分
           ,[krmemo]//仮受付メモ
           ,[ukecd]//受付者コード
           ,[nyutncd//入力者コード？
           ,[ukehkb]//受付方法区分
           ,[kyacd]//顧客コード(mt_kyaku)
           ,[dannm]//団体名 (mt_kyaku)
           ,[dannm2]//団体名２ (mt_kyaku)
           ,[dannmk]//団体カナ名 (mt_kyaku)
           ,[daihyo]//代表者名 (mt_kyaku)
           ,[renraku]//連絡者名
           ,[tel1]//ＴＥＬ１
           ,[tel2]//ＴＥＬ２
           ,[fax]//ＦＡＸ
           ,[zipcd]//郵便番号(mt_zipcd)
           ,[adr1]//住所１
           ,[adr2]//住所２
           ,[gyscd]//業種コード
           ,[sihon]//資本金
           ,[jygsu]//従業員数
           ,[kyakb]//顧客区分
           ,[kaigi]//会議名称
           ,[kaigir]//会議名称
           ,[naiyo]//内容
           ,[kbiko]//顧客備考
           ,[kupdkb]//顧客更新区分
           ,[rsbkb]//予約種別区分(ct_rsb)
           ,[riyokb]//利用目的区分(mm_riyo)
           ,[login]
           ,[udate]
           ,[utime])
     VALUES
           (<ukeno, int,>
           ,<ukedt, int,>
           ,<nen, int,>
           ,<krkb, smallint,>
           ,<krmemo, varchar(40),>
           ,<ukecd, int,>
           ,<nyutncd, int,>
           ,<ukehkb, smallint,>
           ,<kyacd, int,>
           ,<dannm, varchar(40),>
           ,<dannm2, varchar(40),>
           ,<dannmk, varchar(20),>
           ,<daihyo, varchar(40),>
           ,<renraku, varchar(40),>
           ,<tel1, varchar(15),>
           ,<tel2, varchar(15),>
           ,<fax, varchar(15),>
           ,<zipcd, varchar(10),>
           ,<adr1, varchar(40),>
           ,<adr2, varchar(40),>
           ,<gyscd, int,>
           ,<sihon, int,>
           ,<jygsu, int,>
           ,<kyakb, smallint,>
           ,<kaigi, varchar(40),>
           ,<kaigir, varchar(20),>
           ,<naiyo, varchar(20),>
           ,<kbiko, varchar(40),>
           ,<kupdkb, smallint,>
           ,<rsbkb, smallint,>
           ,<riyokb, int,>
           ,<login, varchar(20),>
           ,<udate, int,>
           ,<utime, int,>)*/
		   
		   //明細（複数ある場合もある
		  /*INSERT INTO [dbo].[dt_roomrmei]
           ([ukeno]
           ,[gyo]
           ,[rmcd]
           ,[kyono]
           ,[kyodt]
           ,[usedt]
           ,[yobi]
           ,[yobikb]
           ,[timekb]
           ,[stjkn]
           ,[edjkn]
           ,[hbstjkn]
           ,[hbedjkn]
           ,[ratekb]
           ,[ratesb]
           ,[zgrt]
           ,[ninzu]
           ,[rmtnk]
           ,[rmentnk]
           ,[rmtukin]
           ,[rmenkin]
           ,[rmkin]
           ,[hzkin]
           ,[rmnykin]
           ,[hznykin]
           ,[synykin]
           ,[candt]
           ,[cankb]
           ,[hkktdt]
           ,[hkdt]
           ,[hkkin]
           ,[kskbn]
           ,[biko]
           ,[tag1]
           ,[tag2]
           ,[tag3]
           ,[login]
           ,[udate]
           ,[utime])
     VALUES
           (<ukeno, int,>
           ,<gyo, smallint,>
           ,<rmcd, int,>
           ,<kyono, int,>
           ,<kyodt, int,>
           ,<usedt, int,>
           ,<yobi, varchar(4),>
           ,<yobikb, smallint,>
           ,<timekb, smallint,>
           ,<stjkn, int,>
           ,<edjkn, int,>
           ,<hbstjkn, int,>
           ,<hbedjkn, int,>
           ,<ratekb, int,>
           ,<ratesb, int,>
           ,<zgrt, int,>
           ,<ninzu, int,>
           ,<rmtnk, int,>
           ,<rmentnk, int,>
           ,<rmtukin, int,>
           ,<rmenkin, int,>
           ,<rmkin, int,>
           ,<hzkin, int,>
           ,<rmnykin, int,>
           ,<hznykin, int,>
           ,<synykin, int,>
           ,<candt, int,>
           ,<cankb, smallint,>
           ,<hkktdt, int,>
           ,<hkdt, int,>
           ,<hkkin, int,>
           ,<kskbn, int,>
           ,<biko, varchar(40),>
           ,<tag1, smallint,>
           ,<tag2, smallint,>
           ,<tag3, smallint,>
           ,<login, varchar(20),>
           ,<udate, int,>
           ,<utime, int,>)*/
		   
		   
?>
  <table>
<caption>スタッフリスト</caption>
<?php
    //実行結果を描画
    //while($row = sqlsrv_fetch_array($result)) {
    //     printf("<tr><td class='hdr'>".$row['id']."</td>");
    //    printf("<td>".$row['name']."</td></tr>");
   // }
   
   print_r($_POST);
?>
</table>
<?php
//クエリー結果の開放
sqlsrv_free_stmt($result);
//コネクションのクローズ
sqlsrv_close($conn);
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
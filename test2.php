<?php
//if(empty($_SESSION)){
//	location.href = "top.php";
//}
if(empty($_SESSION[webrk][user][userid])){
	header("Location : top.php");
	//location.href = "http://itweb1/rk_kik/top.php";

}
//require_once( "func.php" );
//require_once( "model/db.php" );

/* �f�[�^�x�[�X�ڑ� */
//$db = new DB;
//$conErr = $db->connect();
//if ( !empty( $conErr ) ) { echo $conErr;  die(); } //�ڑ��s���͏I��
//echo $db->check_monthly_count(1,2015,4);
//$sttdt= "2015/09/25";
//$enddt= "2015/10/08";

//$sttdt= "2015/09/11";
//$enddt= "2015/10/01";
//$arr = get_date_array( $sttdt , $enddt ,  array( 0,1,2,3,4,5,6 ) ) ;
//print_r($arr);
//
//echo "<br> count is ".count($arr);
?>
<?php 
//----------------------
//対象日
//----------------------
//本当は$date_arrayはクラスを作成してそこから取ったほうが良い

for ( $k = 0; $k < count ( $date_array ) ; $k++ ) {
    echo "<th width=\"50\">".intval( $date_array[ $k ][ 'mm' ] )."</th>";
}

echo "</tr>";
echo "<tr class=\"head\">";

for ( $k = 0; $k < count ( $date_array ) ; $k++ ) {
	echo "<th>".intval( $date_array[ $k ][ 'dd' ] )."</th>";
}

echo "</tr>";
echo "<tr class=\"head\">";

for ( $k = 0; $k < count ( $date_array ) ; $k++ ) {
	
	$w = $date_array[ $k ][ 'w' ];
	$wd = $date_array[ $k ][ 'wd' ];
	
	if( $w == 6 ){      //土曜日の場合
    
		echo "<th class=\"col-sat\">".$wd."</th>";
    
	}elseif( $w == 0 ){ //日曜日の場合
    
		echo "<th class=\"col-sun\">".$wd."</th>";
    
	}else{
    
		echo "<th>".$wd."</th>";
    
	}

}
?>
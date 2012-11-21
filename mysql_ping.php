<html>
<head>
	<title>MySQL Ping</title>
</head>
<body>
	Is the Connection online: 
<?php 
	
	$conn = mysql_connect('mysql02.experienciasdevida2.hospedagemdesites.ws', 'experienciasde', 'msf@321');
	//$db   = mysql_select_db('mydb');

	$mysql_ping = mysql_ping($conn);
	if (false === mysql_ping) {
		echo 'false';
	} elseif($mmysql_ping) {
		echo 'True';
		echo '<br /> $mmysql_ping =';
		print_r($mmysql_ping);
	} else {
		echo 'Unresolved';
		echo '<br /> $conn = ';
		print_r($conn);
		echo '<br /> $mmysql_ping =';
		print_r($mmysql_ping);
	}
?>
</body>
</html>


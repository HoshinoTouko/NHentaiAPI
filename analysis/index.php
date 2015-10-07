<?php
include_once("../config.php");
?>

<?php
//连接数据库
$con = mysql_connect(_SERVERNAME, _USERNAME, _PASSWORD);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//echo "Connected successfully";

//写入次数统计信息
mysql_select_db("NHBooks", $con);

$result = mysql_query("SELECT * FROM requestTimeCount");

//获得上次统计次数
while($row = mysql_fetch_array($result))
  {
  echo $row['count'] . "<br>";
  }

mysql_close($con);



showMAC();
?>


<?php

function showMAC()
{
	//连接数据库
	$con = mysql_connect(_SERVERNAME, _USERNAME, _PASSWORD);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	//echo "Connected successfully";
	mysql_select_db("NHBooks", $con);
	$result = mysql_query("SELECT * FROM MACanalysis");
	$people = 0;
	while($row = mysql_fetch_array($result))
	{
		echo $row['MACMD5'] . " " . $row['times'];
		echo "<br/>";
		$people++;
	}
	echo "All People : " . $people;
	mysql_close($con);
	
}

?>


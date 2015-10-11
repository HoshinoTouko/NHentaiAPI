<?php 

function analysisMAC($MACAddress)
{
	if ($MACAddress == ''){$MACAddress = "NoName";}

	//连接数据库
	$con = mysql_connect(_SERVERNAME, _USERNAME, _PASSWORD);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	//echo "Connected successfully";
	
	mysql_select_db("NHBooks", $con);
	
	$t = false;
	
	$result = mysql_query("SELECT * FROM MACanalysis");
	while($row = mysql_fetch_array($result))
	{
		$times = $row['times'] + 1;
		if($row['MACMD5'] == $MACAddress)
		{
			$t = true;
			mysql_query("UPDATE MACanalysis SET times = " . "'" . $times . "'");
		}
	}
	
	if ($t == false)
	{
		//echo yes;
		mysql_query("INSERT INTO MACanalysis (MACMD5, times) VALUES ('" . $MACAddress . "', 1)");
	}
	
	
	mysql_close($con);
}



function Analysis()
{
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
		//echo $row['count'];
		$requestTimeCount = $row['count'];
	}

	//更新次数
	$requestTimeCount++;
	mysql_query("UPDATE requestTimeCount SET count = " . "'" . $requestTimeCount . "'");

	mysql_close($con);
}

?>
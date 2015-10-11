<?php
//头部保留信息
//HoshinoTouko
//2015-10-02 18:20
include_once("../config.php");
$bookID = $_GET['id'];
$MACMD5 = $_GET['mac'];
if ($bookID == '')
{
	$dieObj = array("error" => "NoID");
	echo json_encode($dieObj);
	die;
}
header('content-type:text/html;charset="utf-8"');
error_reporting(0);

?>

<?php
//引用函数
include("functions.php");
//引用统计
//include_once("analysis.php"); 
//Analysis();
//analysisMAC($MACMD5);
?>

<?php 
//引用simple_html_dom
include_once("../simple_html_dom.php"); 

//返回信息
echo urldecode(getGallery($bookID));
?>


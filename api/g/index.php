<?php
header('content-type:text/html;charset="utf-8"');
error_reporting(0);
//头部保留信息
//HoshinoTouko
//2015-10-02 18:20
//引用函数
include("../functions.php");
include("../config.php");
//引用统计
include("../analysis/analysis.php");
Analysis();
//analysisMAC($MACMD5);
$bookID = isset($_GET['id']) ? intval($_GET['id']) : -1;
$MACMD5 = isset($_GET['mac']) ? intval($_GET['mac']) : 0;

if ($bookID === -1)
{
	$dieObj = array("error" => "NoID");
	echo json_encode($dieObj);
	die;
}



//main
$galleryDetail = getGalleryDetailById($bookID);
$recommend = getGalleryInfo('http://nhentai.net/g/' . $bookID);
$galleryOutput = array(
						"Detail" => $galleryDetail,
						"Recommend" => $recommend
						);
$temp = json_encode($galleryOutput, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
echo urldecode($temp);
?>

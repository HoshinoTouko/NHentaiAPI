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
?>


<?php
$pageFromHome = $_GET['page'];
if ($pageFromHome == ''){$pageFromHome = 1;}
$url = 'http://nhentai.net/?page=' . $pageFromHome;

$galleryInfo = getGalleryInfo($url);
$temp = json_encode($galleryInfo, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
echo urldecode($temp);
?>
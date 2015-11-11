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
$wordsForSearch = $_GET['words'];
$words = getBetween($wordsForSearch, '{', '/');
$page = getBetween($wordsForSearch, '/', '}');
$url = 'http://nhentai.net/search/?q=' . $words . '&page=' . $page;

$galleryInfo = getGalleryInfo($url);
$temp = json_encode($galleryInfo, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
echo urldecode($temp);
?>
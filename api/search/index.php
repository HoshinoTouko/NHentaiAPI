<?php
header('content-type:text/html;charset="utf-8"');
error_reporting(0);
//ͷ��������Ϣ
//HoshinoTouko
//2015-10-02 18:20
//���ú���
include("../functions.php");
include("../config.php");
//����ͳ��
include("../analysis/analysis.php");
Analysis();

//==========================================================


$wordsForSearch = isset($_GET['words']) ? $_GET['words'] : null;
$words = getBetween($wordsForSearch, '{', '/');
$page = getBetween($wordsForSearch, '/', '}');
$url = 'http://nhentai.net/search/?q=' . $words . '&page=' . $page;

$galleryInfo = getGalleryInfo($url);
$temp = json_encode($galleryInfo, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
echo urldecode($temp);
?>

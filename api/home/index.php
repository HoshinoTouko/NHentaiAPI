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
?>


<?php
$pageFromHome = $_GET['page'];
if ($pageFromHome == ''){$pageFromHome = 1;}
$url = 'http://nhentai.net/?page=' . $pageFromHome;

$galleryInfo = getGalleryInfo($url);
$temp = json_encode($galleryInfo, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
echo urldecode($temp);
?>
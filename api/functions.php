<?php

//引用simple_html_dom
include_once("../simple_html_dom.php"); 

//主要函数


//获取Tag信息。如果无tag信息则返回漫画
//用于/t
function getTagsInfoByUrl($url)
{
    //Load url
    $html = file_get_html($url);
    
    $classCount = substr_count($html, 'class="tag tag-'); 
    
    if($classCount == 0)
    {
        return getGalleryInfo($url);
    }

    if ($html == '')
    {
        $dieObj = array("error" => "404 Not Found");
        echo json_encode($dieObj);
        die;
    }
    $tempHtml = $html->find('div[id=tag-container]', 0);
    //echo $tempHtml;
    $output = array();
    
    $iii = 0;
    while ($iii < $classCount)
    {
        $tempHtmlItem = $tempHtml->find('a[class=tag]', $iii);
        $tagUrl = getbetween($tempHtmlItem, '<a href="/', '/"');
        $tagFather = getbetween($tempHtmlItem, '<a href="/', '/');
        $tagSon = getbetween($tagUrl, '/', '/"');
        //echo $tagUrl . '<br>';
        $tempItem = array
        (
            'tagUrl' => urlencode('http://nhentai.net/' . $tagUrl),
            'tagFather' => $tagFather,
            'tagSon' => $tagSon
        );
        array_push($output, $tempItem);
        $iii ++;
    }
    return $output;
}



//获取某本漫画的详细信息 class="thumb-container"
//用于/g
function getGalleryDetailById($bookID)
{
	//Load url
	$html = file_get_html('http://nhentai.net/g/' . $bookID);
	if ($html == '')
	{
		$dieObj = array("error" => "the book do not exist");
		echo json_encode($dieObj);
		die;
	}

	//Find Gallery ID
	$tempTextForID = $html->find('a[href=/g/' . $bookID . '/1/]',0);
	$galleryID = getBetween($tempTextForID, 't.nhentai.net/galleries/','/cover');

	//How many images in the gallery
	//$pageCount = 1;
	//while ($html->find('a[class=gallerythumb]',$pageCount) != ''){$pageCount++;}
	$pageCount = substr_count($html, 'class="gallerythumb"');
	
	//Title && TitleJP 
	$tempTextForTitle = $html->find('div[id=info]',0);
	$title = getBetween($tempTextForTitle, '<h1>', '</h1>');
	$titleJP = getBetween($tempTextForTitle, '<h2>', '</h2>');
	
	//uploadTime
	$uploadTime = getBetween($html, 'datetime="', '">');
	
	//uploadTimeText
	$uploadTime = "";
	
	//Parodies Characters Tags Artists Groups Language Category
	$tagscount = substr_count($html, 'class="field-name"');
	//debug
	//echo $tagscount . '<br>' ;
	//if ( $tagscount != 7){echo 'Please Wait.';die;}
	//debug end
	while($tagscount >= 0)
	{
		$tempText = $html->find('div[class=field-name]', $tagscount - 1);
		$tagName = getBetween($tempText, 'class="field-name">', ':' );
		//echo $tagName;
		$$tagName = getClassNamedFieldName($tempText, $tagscount - 1);
		$tagscount--;
	}
	
	//uploadTime
	$uploadTime = getBetween($html, 'datetime="', '">');
	
	
	//uploadTimeText
	$uploadTimeText = getBetween($html, 'datetime="' . $uploadTime . '">', '</time>');
    
    //getType
    $fileType = getBetween($html, $galleryID . '/1t.', '" />');
	
	
	$output = array
	(
		//Parodies Characters Tags Artists Groups Language Category
		"Parodies" => $Parodies,
		"Characters" => $Characters,
		"Tags" => $Tags,
		"Artists" => $Artists,
		"Group" => $Groups,
		"Language" => $Language,
		"Category" => $Category,
		//End
		"bigCoverImageUrl" => urlencode('http://t.nhentai.net/galleries/' . $galleryID . '/cover.' . $fileType),
		"bookId" => $bookID,
		"galleryId" => $galleryID,
		"pageCount" => $pageCount,
		"previewImageUrl" => urlencode('http://t.nhentai.net/galleries/' . $galleryID . '/thumb.' . $fileType),
		"thumbHeight" => 0,
		"thumbWidth" => 0,
		"title" => $title,
		//"titleJP" => $titleJP,
		"uploadTime" => $uploadTime,
		"uploadTimeText" => $uploadTimeText
	);
	$html->clear();
	return $output;
	
	
}

//获取当前页面中class="gallery"的信息
//用于/home等多处
function getGalleryInfo($url)
{
	$output = array();
	//Load url
	$html = file_get_html($url);
	if ($html == '')
	{
		$dieObj = array("error" => "the book do not exist");
        echo json_encode($dieObj);
        die;
	}
	
	//CountGallerys
	$galleryCount = substr_count($html, 'class="gallery"');
	$i = 0;
	while($i < $galleryCount)
	{
		$tempText = $html->find('div[class=gallery]', $i);
		
		$bookID = getBetween($tempText, 'href="/g/', '/"');
		$title = getBetween($tempText, 'class="caption">', '</div>');
		$galleryID = getBetween($tempText, 't.nhentai.net/galleries/','/thumb');
        
        $galleryImgUrl = getBetween($tempText, 'img src="','"'); 
		
		$tempItem = array
		(
			"title" => $title,
			"bookId" => $bookID,
			"galleryId" => $galleryID,
			//"bigCoverImageUrl" => urlencode('http://t.nhentai.net/galleries/' . $galleryID . '/cover.jpg'),
			"previewImageUrl" => urlencode('http:' . $galleryImgUrl),
		);
		array_push($output, $tempItem);
		$i++;
	}
	return $output;
	
}



//次要函数

function getClassNamedFieldName($tempText, $num)
{
	$result = array();
	$jj = 0;
	do
	{
		$tempItem = trim(getBetween($tempText->find('a', $jj), '>', ' <span')); 
		array_push($result, $tempItem);
		$jj++;
	}
	while(getBetween($tempText->find('a', $jj), '>', ' <span') != '');
	return $result;
}


function getBetween($content, $start, $end)
{
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}



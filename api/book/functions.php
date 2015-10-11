<?php

//引用simple_html_dom
include_once("../simple_html_dom.php"); 

//Functions
function getGallery($bookID)
{
	//Load url
	$html = file_get_html('http://nhentai.net/g/' . $bookID . '/');
	if ($html == '')
	{
		$dieObj = array("error" => "the book do not exist");
		echo json_encode($dieObj);
		die;
	}

	//Find Gallery ID
	$tempTextForID = $html->find('a[href=/g/' . $bookID . '/1/]',0);
	$galleryID = GetBetween($tempTextForID, 't.nhentai.net/galleries/','/cover.jpg');

	//How many images in the gallery
	$pageCount = 1;
	while ($html->find('a[class=gallerythumb]',$pageCount) != ''){$pageCount++;}
	
	//Title && TitleJP 
	$tempTextForTitle = $html->find('div[id=info]',0);
	$title = GetBetween($tempTextForTitle, '<h1>', '</h1>');
	$titleJP = GetBetween($tempTextForTitle, '<h2>', '</h2>');
	
	//uploadTime
	$uploadTime = GetBetween($html, 'datetime="', '">');
	
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
		$tempText = $html->find('div[class=field-name]', $tagscount-1);
		$tagName = GetBetween($tempText , 'class="field-name">', ':' );
		//echo $tagName;
		$$tagName = getClassNamedFieldName($tempText, $tagscount-1);
		$tagscount--;
	}
	
	//uploadTime
	$uploadTime = GetBetween($html, 'datetime="', '">');
	
	
	//uploadTimeText
	$uploadTimeText = GetBetween($html, 'datetime="' . $uploadTime . '">', '</time>');
	
	
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
		
		"bigCoverImageUrl" => urlencode('http://t.nhentai.net/galleries/' . $galleryID . '/cover.jpg'),
		"bookId" => $bookID,
		"galleryId" => $galleryID,
		"pageCount" => $pageCount,
		"previewImageUrl" => urlencode('http://t.nhentai.net/galleries/' . $galleryID . '/thumb.jpg'),
		"thumbHeight" => 0,
		"thumbWidth" => 0,
		"title" => $title,
		"titleJP" => $titleJP,
		"uploadTime" => $uploadTime,
		"uploadTimeText" => $uploadTimeText
	);

	
	return json_encode($output, JSON_UNESCAPED_UNICODE);

//Find all images 
//foreach($html->find('img') as $element) 
       //echo $element->src . '<br>';
//echo $html->plaintext;

	//Clear
	$html->clear();
	
}

function getClassNamedFieldName($tempText, $num)
{
	
	$result = array();
	$jj = 0;
	do
	{
		$tempItem = trim(GetBetween($tempText->find('a', $jj), '>', ' <span')); 
		array_push($result, $tempItem);
		$jj++;
	}
	while(GetBetween($tempText->find('a', $jj), '>', ' <span') != '');
	return $result;
}


function GetBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}



//echo '<a href="sample.json">SampleJSON</a>';

?>


# NHentaiAPI  
[Github地址](https://github.com/HoshinoTouko/NHentaiAPI)  
[示例页面](http://demo.touko.moe/nhentai/book/145650)  
# 概述
***
一个用于获取NHentai漫画信息并且返回Json的PHP程序  
### 仍在开发中
# 目前可用
***
/book/*BookID*  
请开启.htaccess支持  
如果不支持，请访问/book/?id=*BookID*  
### 示例Json
***
* Book  
Sample: /book/145650
		{
		    "Parodies": [
		        "kantai collection"
		    ],
		    "Characters": [
		        "hibiki",
		        "ikazuchi"
		    ],
		    "tags": null,
		    "Artists": [
		        "wizakun"
		    ],
		    "Group": [
		        "kuromahou kenkyuujo"
		    ],
		    "Language": [
		        "japanese"
		    ],
		    "Category": [
		        "doujinshi"
		    ],
		    "bigCoverImageUrl": "http://t.nhentai.net/galleries/838111/cover.jpg",
		    "bookId": "145650",
		    "galleryId": "838111",
		    "pageCount": 23,
		    "previewImageUrl": "http://t.nhentai.net/galleries/838111/thumb.jpg",
		    "thumbHeight": 0,
		    "thumbWidth": 0,
		    "title": "[Kuromahou Kenkyuujo (wizakun)] しれーかんしゅーりして 第六駆逐隊 雷 響",
		    "titleJP": "",
		    "uploadTime": "2015-10-02T04:45:39.074659 00:00",
		    "uploadTimeText": "Oct. 2, 2015, 4:45 a.m."
		}
 # 引用
 ***
 本程序引用  
 * [PHP Simple HTML DOM Parser](http://simplehtmldom.sourceforge.net/)  
 
 
 # LICENSE
 ***
 本程序遵守 [署名-非商业性使用-相同方式共享 4.0 国际](http://creativecommons.org/licenses/by-nc-sa/4.0/)  
 其中 [PHP Simple HTML DOM Parser](http://simplehtmldom.sourceforge.net/)部分遵循[MIT协议](http://opensource.org/licenses/mit-license.php)

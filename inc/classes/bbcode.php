<?php
/**
 * BBcode helper class
 *
 * @package    BBcode
 * @category   Helper
 * @author     Chema <chema@garridodiaz.com>
 * @copyright  (c) 2012
 * @license    GPL v3
 */
class bbcode {

	/**
	 *
	 * This function parses BBcode tag to HTML code (XHTML transitional 1.0)
	 *
	 * It parses (only if it is in valid format e.g. an email must to be
	 * as example@example.ext or similar) the text with BBcode and
	 * translates in the relative html code.
	 *
	 * @param string $text
	 * @param boolean $advanced his var describes if the parser run in advanced mode (only *simple* bbcode is parsed).
	 * @return string
	 */
	public static function tohtml($text,$advanced=FALSE,$charset='utf-8'){

		//special chars
		$text  = htmlspecialchars($text, ENT_QUOTES,$charset);

		/**
		 * This array contains the main static bbcode
		 * @var array $basic_bbcode
		 */
		$basic_bbcode = array(
								'[b]', '[/b]',
								'[i]', '[/i]',
								'[u]', '[/u]',
								'[s]','[/s]',
								'[ul]','[/ul]',
								'[li]', '[/li]',
								'[ol]', '[/ol]',
								'[center]', '[/center]',
								'[left]', '[/left]',
								'[right]', '[/right]',
								'[ltr]', '[/ltr]',
								'[rtl]', '[/rtl]',
								'[hr]'
		);

		/**
		 * This array contains the main static bbcode's html
		 * @var array $basic_html
		 */
		$basic_html = array(
								'<b>', '</b>',
								'<i>', '</i>',
								'<u>', '</u>',
								'<s>', '</s>',
								'<ul>','</ul>',
								'<li>','</li>',
								'<ol>','</ol>',
								'<div style="text-align: center;">', '</div>',
								'<div style="text-align: left;">',   '</div>',
								'<div style="text-align: right;">',  '</div>',
								'<p dir="rtl">',  '</p>',
								'<p dir="ltr">',  '</p>',
								'<hr>'
		);

		/**
		 *
		 * Parses basic bbcode, used str_replace since seems to be the fastest
		 */
		$text = str_replace($basic_bbcode, $basic_html, $text);

		//advanced BBCODE
		if ($advanced)
		{
			/**
			 * This array contains the advanced static bbcode
			 * @var array $advanced_bbcode
			 */
			$advanced_bbcode = array(
									 '#\[color=([a-zA-Z]*|\#?[0-9a-fA-F]{6})](.+)\[/color\]#Usi',
									 '#\[size=([0-9][0-9]?)](.+)\[/size\]#Usi',
									 '#\[quote](\r\n)?(.+?)\[/quote]#si',
									 '#\[quote=(.*?)](\r\n)?(.+?)\[/quote]#si',
									 '#\[url](.+)\[/url]#Usi',
									 '#\[url=(.+)](.+)\[/url\]#Usi',
									 '#\[font=(.+)](.+)\[/font\]#Usi',
									 '#\[email]([\w\.\-]+@[a-zA-Z0-9\-]+\.?[a-zA-Z0-9\-]*\.\w{1,4})\[/email]#Usi',
									 '#\[email=([\w\.\-]+@[a-zA-Z0-9\-]+\.?[a-zA-Z0-9\-]*\.\w{1,4})](.+)\[/email]#Usi',
									 '#\[img](.+)\[/img]#Usi',
									 '#\[img=(.+)x(.+)](.+)\[/img]#Usi',
									 '#\[code](\r\n)?(.+?)(\r\n)?\[/code]#si',
									 '#\[youtube]http://[a-z]{0,3}.youtube.com/watch\?v=([0-9a-zA-Z]{1,11})\[/youtube]#Usi',
									 '#\[youtube]([0-9a-zA-Z]{1,11})\[/youtube]#Usi',
									 '#\[aparat](.*?)\[/aparat]#Usi'
			);

			/**
			 * This array contains the advanced static bbcode's html
			 * @var array $advanced_html
			 */
			$advanced_html = array(
									 '<span style="color: $1">$2</span>',
									// '<span style="font-size: $1px">$2</span>',
									 '<font size="$1">$2</font>',
									 "<div class=\"quote\"><span class=\"quoteby\">Disse:</span>\r\n$2</div>",
									 "<div class=\"quote\"><span class=\"quoteby\">Disse <b>$1</b>:</span>\r\n$3</div>",
									 '<a rel="nofollow" target="_blank" href="$1">$1</a>',
									 '<a rel="nofollow" target="_blank" href="$1">$2</a>',
									 '$2',
									 '<a href="mailto: $1">$1</a>',
									 '<a href="mailto: $1">$2</a>',
									 '<a target="_blank" href="$1"><img src="$1" alt="$1" width="300" height="400" /></a>',
									 '<a target="_blank" href="$3"><img src="$3" alt="$3" width="$1" height="$2" /></a>',
									 '<div class="code">$2</div>',
									 '<object type="application/x-shockwave-flash" style="width: 450px; height: 366px;" data="http://www.youtube.com/v/$1"><param name="movie" value="http://www.youtube.com/v/$1" /><param name="wmode" value="transparent" /></object>',
									 '<object type="application/x-shockwave-flash" style="width: 450px; height: 366px;" data="http://www.youtube.com/v/$1"><param name="movie" value="http://www.youtube.com/v/$1" /><param name="wmode" value="transparent" /></object>',
									 '<iframe src="http://www.aparat.com/video/video/embed/videohash/$1/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" height="360" width="500" ></iframe>'
			);

			$text = preg_replace($advanced_bbcode, $advanced_html,$text);
			
			
			$smile_bbcode = array(
									':)',':blink:',':angel:',':angry:','8-)',
									':happy:',':getlost:',':sleeping:',':unsure:',
									':\'(',':ermm:',':alien:',':kissing:',
									':D',':heart:',':(',':O',':P',
									';)',':sick:',':woot:',':wassat:',':sideways:',
									':silly:',':ninja:',':devil:',':blush:',':cheerful:',':pinch:'
			);
			$smilename = array(
									'smile','blink','angel','angry','cool',
									'happy','getlost','sleeping','unsure',
									'cwy','ermm','alien','kissing',
									'grin','heart','sad','shocked','tongue',
									'wink','sick','w00t','wassat','sideways',
									'silly','ninja','devil','blush','cheerful','pinch'
			);
			$smiledir = '/theme/microblog/editor/themes/emoticons';
			$smile_html = array();
			
			foreach($smilename as $smiles){
				$smile_html[] = "<img src='$smiledir/$smiles.png'>";
			}
			
			$text = str_replace($smile_bbcode, $smile_html,$text);
			
		}
	
		//before return convert line breaks to HTML
		
		$text = preg_replace(array(
									'#\[size=(.+)\]#Usi',
									'#\[color=(.+)\]#Usi',
									'#\[url=(.+)\]#Usi',
									'#\[font=(.+)\]#Usi',
									'#\[img=(.+)\]#Usi',
									'#\[\/size\]#si',
									'#\[\/color\]#si',
									'#\[\/url\]#si',
									'#\[\/font\]#si',
									'#\[\/img\]#si',
									'#\[sup\]#si',
									'#\[\/sup\]#si'
									
								  ), '',$text);
		$text = str_replace(array('[justify]','[/justify]'), '',$text);
		
		return bbcode::nl2br($text);

	}

	/**
	 *
	 * removes bbcode from text
	 * @param string $text
	 * @return string text cleaned
	 */
	public static function remove($text)
	{
		return strip_tags(str_replace(array('[',']'), array('<','>'), $text));
	}

	/**
	 *
	 * Inserts HTML line breaks before all newlines in a string
	 * @param string $var
	 */
	public static function nl2br($var)
	{
		return str_replace(array('\\r\\n','\r\\n','r\\n','\r\n', '\n', '\r'), '<br />', nl2br($var));
	}
	public static function SmileComment($string){
		$codes = array("sNhkq-1","vMqtt-2","f4MwE-3","yePUm-4","1b0pv-5","U9gid-6","pnjJe-7","KVELL-8","Vm3tj-9","ZJe85-10","ekyQu-11","UEdc9-12","vZRYP-13","0PoEA-14","SbDaY-15","RXP0w-16","YWVcg-17","u9TnZ-18","1y85t-19","D0gT2-20","JqeFr-21","eRAoW-22","tUpaW-23","a0pAR-24","TLxPW-25","hwrVV-26","0uLcS-27","yqgPB-28","dewdf-29","1OJVe-30","HQv3e-31","AnXJA-32","d01CK-33","U6V8p-34","CL1NV-35","VGXjz-36","sjUCp-37","A9TXy-38","ysudq-39","WYmty-40","j6RZ0-41","weWrq-42","NqExQ-43","QvcvE-44","vg7is-45","NOWe9-46","p9SQ1-47","tmTz6-48","hctOi-49","9Vixm-50","bCqiG-51","APwMx-52","3S8A7-53","P8y7S-54","EnbjX-55","5XiWX-56","EkzKo-57","j0GiG-58","s6PS8-59","FhYhC-60","JLNOh-61","9iKZ7-62","bhqz9-63","ePzwL-64","RqhgF-65","T3OgC-66","IB2cd-67","S1wHd-68","7ajK2-69","0eWIk-70","El76n-71","1XQ4h-72","Nst9M-73","xc8u7-74","rptrg-75","VwkN6-76","3KCAJ-77","72x54-78","cy2hW-79","GW7ic-80","xtIIF-81","ebo9g-82","4QL7e-83","C64tp-84","ZhSBW-85","CnCUK-86","s3cDJ-87","8HaKq-88","Kb2Bp-89","46O2I-90","3g5dH-91","CEH3Z-92","KUYAR-93","1ViFe-94","XFeab-95","VaLtD-96","snQoA-97","XBZhS-98","LYkos-99","i9ErM-100","DBUdt-101","2hzTB-102","Hhz8t-103","fPPqL-104","D4t6c-105","gHZbS-106","2YCdE-107","aPRd0-108","4eywh-109","4Kb0O-110","PJh3T-111","aFflr-112","Nxrs7-113","P0yPn-114","BwplU-115","19Pg8-116","y4PEx-117","B0VYB-118","aYclP-119");	
		$urls  = array("<img src=/theme/microblog/images/smiley/1.gif>","<img src=/theme/microblog/images/smiley/2.gif>","<img src=/theme/microblog/images/smiley/3.gif>","<img src=/theme/microblog/images/smiley/4.gif>","<img src=/theme/microblog/images/smiley/5.gif>","<img src=/theme/microblog/images/smiley/6.gif>","<img src=/theme/microblog/images/smiley/7.gif>","<img src=/theme/microblog/images/smiley/8.gif>","<img src=/theme/microblog/images/smiley/9.gif>","<img src=/theme/microblog/images/smiley/10.gif>","<img src=/theme/microblog/images/smiley/11.gif>","<img src=/theme/microblog/images/smiley/12.gif>","<img src=/theme/microblog/images/smiley/13.gif>","<img src=/theme/microblog/images/smiley/14.gif>","<img src=/theme/microblog/images/smiley/15.gif>","<img src=/theme/microblog/images/smiley/16.gif>","<img src=/theme/microblog/images/smiley/17.gif>","<img src=/theme/microblog/images/smiley/19.gif>","<img src=/theme/microblog/images/smiley/18.gif>","<img src=/theme/microblog/images/smiley/20.gif>","<img src=/theme/microblog/images/smiley/21.gif>","<img src=/theme/microblog/images/smiley/22.gif>","<img src=/theme/microblog/images/smiley/23.gif>","<img src=/theme/microblog/images/smiley/24.gif>","<img src=/theme/microblog/images/smiley/25.gif>","<img src=/theme/microblog/images/smiley/26.gif>","<img src=/theme/microblog/images/smiley/27.gif>","<img src=/theme/microblog/images/smiley/28.gif>","<img src=/theme/microblog/images/smiley/29.gif>","<img src=/theme/microblog/images/smiley/30.gif>","<img src=/theme/microblog/images/smiley/31.gif>","<img src=/theme/microblog/images/smiley/32.gif>","<img src=/theme/microblog/images/smiley/33.gif>","<img src=/theme/microblog/images/smiley/37.gif>","<img src=/theme/microblog/images/smiley/38.gif>","<img src=/theme/microblog/images/smiley/34.gif>","<img src=/theme/microblog/images/smiley/35.gif>","<img src=/theme/microblog/images/smiley/36.gif>","<img src=/theme/microblog/images/smiley/39.gif>","<img src=/theme/microblog/images/smiley/40.gif>","<img src=/theme/microblog/images/smiley/41.gif>","<img src=/theme/microblog/images/smiley/42.gif>","<img src=/theme/microblog/images/smiley/43.gif>","<img src=/theme/microblog/images/smiley/44.gif>","<img src=/theme/microblog/images/smiley/45.gif>","<img src=/theme/microblog/images/smiley/46.gif>","<img src=/theme/microblog/images/smiley/47.gif>","<img src=/theme/microblog/images/smiley/48.gif>","<img src=/theme/microblog/images/smiley/49.gif>","<img src=/theme/microblog/images/smiley/50.gif>","<img src=/theme/microblog/images/smiley/51.gif>","<img src=/theme/microblog/images/smiley/52.gif>","<img src=/theme/microblog/images/smiley/53.gif>","<img src=/theme/microblog/images/smiley/54.gif>","<img src=/theme/microblog/images/smiley/55.gif>","<img src=/theme/microblog/images/smiley/56.gif>","<img src=/theme/microblog/images/smiley/57.gif>","<img src=/theme/microblog/images/smiley/58.gif>","<img src=/theme/microblog/images/smiley/59.gif>","<img src=/theme/microblog/images/smiley/60.gif>","<img src=/theme/microblog/images/smiley/61.gif>","<img src=/theme/microblog/images/smiley/62.gif>","<img src=/theme/microblog/images/smiley/63.gif>","<img src=/theme/microblog/images/smiley/64.gif>","<img src=/theme/microblog/images/smiley/65.gif>","<img src=/theme/microblog/images/smiley/66.gif>","<img src=/theme/microblog/images/smiley/67.gif>","<img src=/theme/microblog/images/smiley/68.gif>","<img src=/theme/microblog/images/smiley/69.gif>","<img src=/theme/microblog/images/smiley/70.gif>","<img src=/theme/microblog/images/smiley/71.gif>","<img src=/theme/microblog/images/smiley/72.gif>","<img src=/theme/microblog/images/smiley/73.gif>","<img src=/theme/microblog/images/smiley/74.gif>","<img src=/theme/microblog/images/smiley/75.gif>","<img src=/theme/microblog/images/smiley/76.gif>","<img src=/theme/microblog/images/smiley/77.gif>","<img src=/theme/microblog/images/smiley/78.gif>","<img src=/theme/microblog/images/smiley/79.gif>","<img src=/theme/microblog/images/smiley/100.gif>","<img src=/theme/microblog/images/smiley/101.gif>","<img src=/theme/microblog/images/smiley/102.gif>","<img src=/theme/microblog/images/smiley/103.gif>","<img src=/theme/microblog/images/smiley/104.gif>","<img src=/theme/microblog/images/smiley/105.gif>","<img src=/theme/microblog/images/smiley/106.gif>","<img src=/theme/microblog/images/smiley/107.gif>","<img src=/theme/microblog/images/smiley/108.gif>","<img src=/theme/microblog/images/smiley/109.gif>","<img src=/theme/microblog/images/smiley/110.gif>","<img src=/theme/microblog/images/smiley/111.gif>","<img src=/theme/microblog/images/smiley/112.gif>","<img src=/theme/microblog/images/smiley/113.gif>","<img src=/theme/microblog/images/smiley/114.gif>","<img src=/theme/microblog/images/smiley/115.gif>","<img src=/theme/microblog/images/smiley/120.gif>","<img src=/theme/microblog/images/smiley/121.gif>","<img src=/theme/microblog/images/smiley/122.gif>","<img src=/theme/microblog/images/smiley/123.gif>","<img src=/theme/microblog/images/smiley/124.gif>","<img src=/theme/microblog/images/smiley/125.gif>","<img src=/theme/microblog/images/smiley/126.gif>","<img src=/theme/microblog/images/smiley/127.gif>","<img src=/theme/microblog/images/smiley/128.gif>","<img src=/theme/microblog/images/smiley/129.gif>","<img src=/theme/microblog/images/smiley/130.gif>","<img src=/theme/microblog/images/smiley/131.gif>","<img src=/theme/microblog/images/smiley/132.gif>","<img src=/theme/microblog/images/smiley/133.gif>","<img src=/theme/microblog/images/smiley/134.gif>","<img src=/theme/microblog/images/smiley/135.gif>","<img src=/theme/microblog/images/smiley/136.gif>","<img src=/theme/microblog/images/smiley/137.gif>","<img src=/theme/microblog/images/smiley/138.gif>","<img src=/theme/microblog/images/smiley/139.gif>","<img src=/theme/microblog/images/smiley/140.gif>","<img src=/theme/microblog/images/smiley/141.gif>","<img src=/theme/microblog/images/smiley/pirate_2.gif>","<img src=/theme/microblog/images/smiley/transformer_v2.gif>");
		return str_replace($codes, $urls, $string);
	}

}
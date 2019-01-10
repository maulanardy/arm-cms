<?php
class Io
{
	public static function pre($val){
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}

	public static function session($val = false){
		if($val){
			return $_SESSION[$val];
		}else
			return $_SESSION;
	}

	public static function excerpt($str,$maxLength=100, $startPos=0) {
		if(strlen($str) > $maxLength) {
			$excerpt   = substr($str, $startPos, $maxLength-3);
			$lastSpace = strrpos($excerpt, ' ');
			$excerpt   = substr($excerpt, 0, $lastSpace);
			$excerpt  .= '...';
		} else {
			$excerpt = $str;
		}
		
		return $excerpt;
	}

	public static function slugify($text)
	{ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	  // trim
	  $text = trim($text, '-');

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // lowercase
	  $text = strtolower($text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  if (empty($text))
	  {
	    return 'n-a';
	  }

	  return $text;
	}

	public static function param($param, $mode = '')
	{
		if(isset($_GET[$param])){
			$var = $_GET[$param];
		}else if(isset($_POST[$param])){
			$var = $_POST[$param];
		}else{
			$var = false;
		}

		if($var){
			if($mode == 'html'){
				$var = $var;
			}else{
				if(!is_array($var)){
					$var = self::filter($var);
				}else{
					foreach ($var as $k => $v) {
						$var[$k] = self::filter($v);
					}
				}
			}
		}			

		return $var;
	}

	public static function filter($value)
	{

		$value = trim($value);
		$value = strip_tags($value);
		// $value = mysqli::real_escape_string($value);
		$value = htmlspecialchars($value, ENT_IGNORE, 'utf-8');
		$value = stripslashes($value);		
		// $value = urlencode($value);

		return $value;
	}


	public static function uri($i = 1)
	{	
		$uri =  $_SERVER['REQUEST_URI'];
		$uri = str_replace(FOLDER, '', $uri);
		$uri = str_replace("/", " ", $uri);
		$uri = str_replace("?", " ", $uri);
		$uri = explode(' ', trim($uri));

		if($uri[$i - 1]) return $uri[$i - 1];
		else return '';
	}

	public static function encode($string,$key) {
		$string = "%".$string."#";
	    $key = sha1($key);
	    $strLen = strlen($string);
	    $keyLen = strlen($key);
	    for ($i = 0; $i < $strLen; $i++) {
	        $ordStr = ord(substr($string,$i,1));
	        if ($j == $keyLen) { $j = 0; }
	        $ordKey = ord(substr($key,$j,1));
	        $j++;
	        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
	    }
	    return $hash;
	}

	public static function decode($string,$key) {
	    $key = sha1($key);
	    $strLen = strlen($string);
	    $keyLen = strlen($key);
	    for ($i = 0; $i < $strLen; $i+=2) {
	        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
	        if ($j == $keyLen) { $j = 0; }
	        $ordKey = ord(substr($key,$j,1));
	        $j++;
	        $hash .= chr($ordStr - $ordKey);
	    }
	    $hash = str_replace("%", "", $hash);
	    $hash = str_replace("#", "", $hash);
	    return $hash;
	}
}
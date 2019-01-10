<?php

class helper
{
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
	  // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

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
	public static function get_thumb($path, $size)
	{
		$path = explode(".", $path);
		return $path[0].'_'.$size.'.'.$path[1];
	}
	public static function get_client_ip()
	{
	    $ipaddress = '';
	    if ($_SERVER['HTTP_CLIENT_IP'])
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if($_SERVER['HTTP_X_FORWARDED'])
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if($_SERVER['HTTP_FORWARDED_FOR'])
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if($_SERVER['HTTP_FORWARDED'])
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if($_SERVER['REMOTE_ADDR'])
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	public static function datetime_parse($dt, $format = 'Y-m-d h:i:s')
	{
		return ($dt == '0000-00-00 00:00:00' || $dt == null) ? '0000-00-00 00:00:00' : date($format, strtotime($dt));
	}

	public static function month_name($lang = "ina")
	{
		switch ($lang) {
			case 'ina':
				return $month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
				break;
			case 'eng':
				return $month = array('January','February','March','April','May','June','July','August','September','October','November','December');
				break;
			
			default:
				# code...
				break;
		}
	}

	public static function date_name()
	{
		return $day = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	}

	public static function uri($i = 1)
	{	
		$uri =  $_SERVER['REQUEST_URI'];
		$uri = explode("?", $uri)[0];
		$uri = str_replace(FOLDER, '', $uri);
		$uri = str_replace("/", " ", $uri);
		$uri = str_replace("?", " ", $uri);
		$uri = explode(' ', trim($uri));

		if($uri[$i - 1]) return $uri[$i - 1];
		else return '';
	}

	public static function getParam($param, $mode = '')
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
				$var = self::filter($var);
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


    public static function flashdata( $name = '', $message = '', $class = 'text-danger' )
	{
	    //We can only do something if the name isn't empty
	    if( !empty( $name ) )
	    {
	        //No message, create it
	        if( !empty( $message ) && empty( $_SESSION[$name] ) )
	        {
	            if( !empty( $_SESSION[$name] ) )
	            {
	                unset( $_SESSION[$name] );
	            }
	            if( !empty( $_SESSION[$name.'_class'] ) )
	            {
	                unset( $_SESSION[$name.'_class'] );
	            }

	            $_SESSION[$name] = $message;
	            $_SESSION[$name.'_class'] = $class;
	        }
	        //Message exists, display it
	        elseif( !empty( $_SESSION[$name] ) && empty( $message ) )
	        {
	            $class = !empty( $_SESSION[$name.'_class'] ) ? $_SESSION[$name.'_class'] : 'success';
	            $return = $_SESSION[$name];
	            unset($_SESSION[$name]);
	            unset($_SESSION[$name.'_class']);

	            return $return;
	        }
	    }
	}
	
	public static function getApi($url){
		$res = file_get_contents($url);

		if(json_decode($res)){
			return json_decode($res);
		} else {
			return $res;
		}
	}

	public static function zeroPrefixNumeric($num = null, $length = 1)
	{
		if($length > 0 && $num != null){

			$num_length = strlen($num);
			$prefix = "";

			if($num_length < $length)
			{
				for($i = 0; $i < $length - $num_length; $i++)
				{
					$prefix .= "0";
				}

				return $prefix.$num;
			}

			return $num;
		}

		return 0;
	}

	public static function timeAgo($time_ago)
	{
	    $time_ago = strtotime($time_ago);
	    $cur_time   = time();
	    $time_elapsed   = $cur_time - $time_ago;
	    $seconds    = $time_elapsed ;
	    $minutes    = round($time_elapsed / 60 );
	    $hours      = round($time_elapsed / 3600);
	    $days       = round($time_elapsed / 86400 );
	    $weeks      = round($time_elapsed / 604800);
	    $months     = round($time_elapsed / 2600640 );
	    $years      = round($time_elapsed / 31207680 );
	    // Seconds
	    if($seconds <= 60){
	        return "just now";
	    }
	    //Minutes
	    else if($minutes <=60){
	        if($minutes==1){
	            return "one minute ago";
	        }
	        else{
	            return "$minutes minutes ago";
	        }
	    }
	    //Hours
	    else if($hours <=24){
	        if($hours==1){
	            return "an hour ago";
	        }else{
	            return "$hours hrs ago";
	        }
	    }
	    //Days
	    else if($days <= 7){
	        if($days==1){
	            return "yesterday";
	        }else{
	            return "$days days ago";
	        }
	    }
	    //Weeks
	    else if($weeks <= 4.3){
	        if($weeks==1){
	            return "a week ago";
	        }else{
	            return "$weeks weeks ago";
	        }
	    }
	    //Months
	    else if($months <=12){
	        if($months==1){
	            return "a month ago";
	        }else{
	            return "$months months ago";
	        }
	    }
	    //Years
	    else{
	        if($years==1){
	            return "one year ago";
	        }else{
	            return "$years years ago";
	        }
	    }
	}
}
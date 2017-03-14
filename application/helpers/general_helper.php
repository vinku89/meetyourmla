<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Voji general helper functions
*
* @author mvh 3/20/2015
* @copyright Grooters Productions
*
*/


if (!function_exists('contains')){
	/**
	* Case insensitive contains.
	* This helper function is a case insensitive contains function that looks for a string within a string.
	*
	* @param string The string to look for the specified string in (haystack).
	* @param string The string you want to search for (needle).
	*
	* @return bool Returns true if the string is found and false otherwise.
	*/
	function contains ($haystack, $needle) {
	    return !(stripos($haystack, $needle) === false);
	}
}

if (!function_exists('startsWith')){
	function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
}

if (!function_exists('endsWith')){
	function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || strpos($haystack, $needle, strlen($haystack) - strlen($needle)) !== FALSE;
	}
}

if (!function_exists('get_extension_by_mime')){
	function get_extension_by_mime($mimetype) {

		global $mimes;
		if ( ! is_array($mimes)) {
			if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/mimes.php')) {
				include(APPPATH.'config/'.ENVIRONMENT.'/mimes.php');
			} elseif (is_file(APPPATH.'config/mimes.php')) {
				include(APPPATH.'config/mimes.php');
			}
			if ( ! is_array($mimes)) return FALSE;
		}


		$mimetype = trim(strtolower($mimetype));
		$myext = false;

		if ($mimetype) {
			foreach ($mimes as $ext=>$mime) {
				if (is_array($mime)) {
					foreach($mime as $m) {
						if (strtolower($m)==$mimetype) {
							if (!$myext || strlen($myext)>strlen($ext)) $myext=$ext;
						}
					}
				} else {
					if (strtolower($mime)==$mimetype) {
						if (!$myext || strlen($myext)>strlen($ext)) $myext=$ext;
					}
				}
			}
			// last ditch effort - take everything after the slash
			if (!$myext) {
				$pos = strpos($mimetype, '/');
				if ($pos>0) $myext = substr($mimetype, $pos+1);
			}

		}

		return $myext;
	}
}


if (!function_exists('parse_media_object_identifier')){
	/**
	* parse a media object as stored in Voji DB
	* @param string: will be format   {voji:uuid}   or   {taxlt:uuid}   or   {image:uuid}
	* 
	* @return array or false
	*/
	function parse_media_object_identifier($identifier) {

		// text will be format   {voji:uuid}   or   {taxlt:uuid}   or   {image:uuid}   or   {vext:uuid}
		if (preg_match('/^{(voji|talxt|image|vext|post):(.+)}$/', trim(strtolower($identifier)), $matches) && count($matches)==3) {
			return array(
				'type' => $matches[1],
				'table' => ($matches[1]=='voji' ? 'voji' : 'othermedia'),
				'uuid' => $matches[2],
			);
		}

		return false;
	}
}

if (!function_exists('is_social_username')){
	/** 
	* check if a username is a social platform
	*
	* @return Boolean
	*/
	function is_social_username($mystring) {
		$pattern = '/^(facebook|twitter|linkedin):.+$/';
		return (preg_match($pattern, $mystring)===1);
	}
}


if (!function_exists('in_arrayi')) {
	/**
	* case-insensitive in_array()
	*/
	function in_arrayi($needle, $haystack) {
		return in_array(strtolower($needle), array_map('strtolower', $haystack));
	}
}


if (!function_exists('mysql_string_with_tz_to_unixtime')) {
	/**
	* in case mysql server and web server are in different timezones, pulling a Mysql timestamp into a string could be dangerous
	*/
	function mysql_string_with_tz_to_unixtime($mysql_datestring, $mysql_tz) {
		$dt = new DateTime($mysql_datestring, new DateTimeZone($mysql_tz));
		return $dt->getTimestamp();
	}
}


if (!function_exists('boolean_string_to_int')) {
	/**
	* convert 'true', 'false', '0', '1', etc - to a integer
	*/
	function boolean_string_to_int($mystring) {
		if (is_string($mystring) && strtolower(substr($mystring,0,1))=='t') {
			return 1;
		} else {
			return (int)$mystring;
		}
	}
}

if (!function_exists('fraction_to_decimal')) {
	function fraction_to_decimal($input) {
		$values = array('num' => 0);
		preg_match('/^(?P<num>\d+)\/(?P<den>\d+)$/', $input, $values);
		if (array_key_exists('den', $values) && !$values['den']) {
			$result = 0; // intercept division by zero error
		} else {
			$result = $values['den'] ? $values['num']/$values['den'] : $input;
		}
		return (float) $result;
	}
}


if (!function_exists('normalize_phone_number')) {
	/**
	* convert a written phone number string to a normalized internal format
	* '+1 (616) 846-1234', '616-846-1234', and '011 1 616 846 1234' will all convert to '+16168461234'
	* 
	* @param string
	* @return string
	*/
	function normalize_phone_number($phone_string) {
		$phone_string = trim($phone_string);

		// replace leading "011" with "+"
		if (substr($phone_string,0,3)=='011') $phone_string = '+' . trim(substr($phone_string,3));

		// get numbers only
		$phone_nums = preg_replace('/[^0-9]/','',$phone_string);
		$totnums = strlen($phone_nums);

		// we need to have at least 7 numbers
		if ($totnums<7) return '';

		// if the number started with a "+", leave it
		if (substr($phone_string,0,1)=='+') {
			return '+'.$phone_nums;
		}

		// if we have 10 digits not starting with a zero or 1, we'll assume a US number
		if ($totnums==10 && substr($phone_nums,0,1)!='0' && substr($phone_nums,0,1)!='1') {
			return '+1'.$phone_nums;
		}

		// if we have 11 digits starting with a 1, we'll assume a US number
		if ($totnums==11 && substr($phone_nums,0,1)=='1') {
			return '+'.$phone_nums;
		}

		// not sure - let's just add a "+" and hope the country code is in there
		return '+'.$phone_nums;

	}
}
if (!function_exists('timestamp_convert')) {
    /**
	* convert timestamp  to a normalized internal format
	* 
	* @param int
	* @return string
	*/
    function timestamp_convert($timestamp) {
        //type cast, current time, difference in timestamps
        $timestamp = (int) $timestamp;
        $current_time = time();
        $diff = $current_time - $timestamp;

        //intervals in seconds
        $intervals = array(
            'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
        );

        //now we just find the difference
        if ($diff == 0) {
            return 'just now';
        }

        if ($diff < 60) {
            return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
        }

        if ($diff >= 60 && $diff < $intervals['hour']) {
            $diff = floor($diff / $intervals['minute']);
            return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
        }

        if ($diff >= $intervals['hour'] && $diff < $intervals['day']) {
            $diff = floor($diff / $intervals['hour']);
            return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
        }

        if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
            $diff = floor($diff / $intervals['day']);
            return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
        }

        if ($diff >= $intervals['week'] && $diff < $intervals['month']) {
            $diff = floor($diff / $intervals['week']);
            return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
        }

        if ($diff >= $intervals['month'] && $diff < $intervals['year']) {
            $diff = floor($diff / $intervals['month']);
            return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
        }

        if ($diff >= $intervals['year']) {
            $diff = floor($diff / $intervals['year']);
            return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
        }
    }
    
}


<?php

class URL {
	public static function concatenate($url1, $url2) {
		$sufix = ((substr($url2, -1) !== "/" && strpos($url2, ".") === false)?"/":"");
		if (substr($url1, -1) !== "/" && substr($url2, 0, 1) !== "/") {
			return $url1."/".$url2.$sufix;
		}
		if (substr($url1, -1) === "/" && substr($url2, 0, 1) === "/") {
			return $url1.substr($url2, 1).$sufix;
		}
		return $url1.$url2.$sufix;
	}

	public static function concat($url1, $url2) {
		return self::concatenate($url1, $url2);
	}
}
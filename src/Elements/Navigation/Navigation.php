<?php

namespace Elements\Navigation;

use \Rossato\Element;
use \Elements\MaterialIcon;
use \URL;

class Navigation extends Element {
	public function __construct($config, $class="mdl-navigation", $content=null) {
		parent::__construct(
			"nav",
			["class" => $class],
			array_map(
				function($urlData) use ($config) {
					return new Element(
						"a",
						[
							"class" => "mdl-navigation__link",
							"href" => URL::concatenate($config["url-prefix"], $urlData["href"])
						],
						$urlData["name"]
					);
				},
				$config["routes"]["navigation"]
			)
		);
		if ($content) {
			$this->add($content);
		}
	}
}
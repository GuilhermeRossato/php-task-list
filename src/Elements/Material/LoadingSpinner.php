<?php

namespace Elements\Material;

use \Rossato\Element;

class LoadingSpinner extends Element {
	public function __construct($config=[]) {
		$className = "mdl-spinner is-active";
		if ($config["single-color"]) {
			$className .= " mdl-spinner--single-color mdl-js-spinner";
		} else {
			$className .= " mdl-js-spinner";
		}
		parent::__construct("div", ["class" => $className]);
		if ($config["radius"]) {
			$this->setAttribute(
				"style",
				"width:".$config["radius"]."px; height:".$config["radius"]."px;"
			);
		}
	}
}
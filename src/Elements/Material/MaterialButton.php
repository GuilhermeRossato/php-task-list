<?php

namespace Elements\Material;

use \Rossato\Element;

class MaterialButton extends Element {
	public function __construct($config) {
		if ($config["flat"]) {
			$className = "mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect";
		} else if ($config["fab"] === "mini") {
			$className = "mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab";
		} else if ($config["icon"] === "colored") {
			$className = "mdl-button mdl-js-button mdl-button--icon mdl-button--colored";
		} else if ($config["icon"]) {
			$className = "mdl-button mdl-js-button mdl-button--icon";
		} else {
			$className = "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent";
		}

		parent::__construct(
			"button",
			[
				"class" => $className,
				"href" => $config["href"]?$config["href"]:false,
				"onclick" => $config["onclick"]?$config["onclick"]:false
			],
			$config["content"]
		);
	}
}
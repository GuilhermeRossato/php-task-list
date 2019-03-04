<?php

namespace Elements\Material;

use \Rossato\Element;

class MaterialCheckbox extends Element {
	public function __construct($config) {
		if (array_key_exists("id", $config)) {
			$name = $config["id"];
		} else {
			if (is_array($config["label"])) {
				$name = str_replace(" ", "-", strtolower($config["label"][0]));
			} else {
				$name = str_replace(" ", "-", strtolower($config["label"]));
			}
		}

		parent::__construct(
			"label",
			["class" => "mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect", "for" => $name],
			[
				new Element(
					"input",
					[
						"class" => "mdl-checkbox__input",
						"type" => "checkbox",
						"id" => $name,
						"name" => $name
					]
				),
				new Element(
					"label",
					["class" => "mdl-checkbox__label"],
					$config["label"]
				)
			]
		);
	}
}
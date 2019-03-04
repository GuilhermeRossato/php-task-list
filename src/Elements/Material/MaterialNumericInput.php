<?php

namespace Elements\Material;

use \Rossato\Element;

class MaterialNumericInput extends Element {
	public function __construct($config) {
		if (array_key_exists("id", $config)) {
			$name = $config["id"];
		} else {
			$name = str_replace(" ", "-", strtolower($config["label"]));
		}
		parent::__construct(
			"div",
			["class" => "mdl-textfield mdl-js-textfield mdl-textfield--floating-label"],
			[
				new Element(
					"input",
					[
						"class" => "mdl-textfield__input",
						"type" => "text",
						"id" => $name,
						"name" => $name
					]
				),
				new Element(
					"label",
					[
						"class" => "mdl-textfield__label",
						"for" => $name,
						"pattern" => "-?[0-9]*(\.[0-9]+)?"
					],
					$config["label"]
				),
				new Element(
					"span",
					["class" => "mdl-textfield__error"],
					"Input must be a number"
				)
			]
		);

	}
}
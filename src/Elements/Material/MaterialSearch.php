<?php

namespace Elements\Material;

use \Rossato\Element;
use \Elements\Material\MaterialIcon;

class MaterialSearch extends Element {
	public function __construct($placeholder = "Search Here") {
		static $index = 0;
		$index++;
		$id = "material-search-".$index;

		parent::__construct(
			"form",
			["action" => "#", "autocomplete" => "off"],
			[
				new Element(
					"label",
					[
						"class" => "mdl-button mdl-js-button mdl-button--icon",
						"for" => $id
					],
					new MaterialIcon("search")
				),
				new Element(
				"div",
				["class" => "mdl-textfield mdl-js-textfield"],
					[
						new Element(
							"input",
							[
								"class" => "mdl-textfield__input",
								"type" => "text",
								"id" => $id,
								"name" => $id
							]
						),
						new Element(
							"label",
							[
								"class" => "mdl-textfield__label",
								"for" => "expandable"
							],
							$placeholder
						)
					]
				)
			]
		);
	}
}

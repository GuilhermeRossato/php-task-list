<?php

namespace Elements\Material;

use \Rossato\Element;
use \Elements\Material\MaterialIcon;

class ExpandingSearch extends Element {
	public function __construct($placeholder = "Expandable Search") {
		static $index = 0;
		$index++;
		$id = "expanding-search-".$index;

		parent::__construct(
			"form",
			["action" => "#"],
			new Element(
				"div",
				["class" => "mdl-textfield mdl-js-textfield mdl-textfield--expandable"],
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
						["class" => "mdl-textfield__expandable-holder"],
						[
							new Element(
								"input",
								[
									"class" => "mdl-textfield__input",
									"type" => "text",
									"id" => $id
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
			)
		);
	}
}

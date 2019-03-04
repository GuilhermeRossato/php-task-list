<?php

namespace Elements\Header;

use \Rossato\Element;

use \Elements\Navigation\Navigation;

use \Elements\Material\MaterialSearch;

class Drawer extends Element {
	public function __construct($config) {
		$search = new MaterialSearch("Search tasks");
		$search->addAttribute(
			"style",
			"display:flex;justify-content:center;align-items:center;padding: 0 16px"
		);
		parent::__construct(
			"div",
			["class" => "mdl-layout__drawer"],
			[
				new Element("span", ["class" => "mdl-layout-title"], $config["header"]["title"]),
				new Navigation(
					$config,
					"mdl-navigation",
					$search
				)
			]
		);
	}
}
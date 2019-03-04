<?php

namespace Elements\Header;

use \Rossato\Element;

use \Elements\Navigation\Navigation;

use \Elements\Material\ExpandingSearch;

class Header extends Element {
	public function __construct($config) {
		parent::__construct("header", ["class"=>"mdl-layout__header"]);
		$this->add(
			new Element(
				"div",
				["class"=>"mdl-layout__header-row"],
				[
					new Element(
						"span",
						["class" => "mdl-layout-title"],
						$config["header"]["title"]
					),
					new Element(
						"div",
						["class" => "mdl-layout-spacer"]
					),
					new Navigation(
						$config,
						"mdl-navigation mdl-layout--large-screen-only",
						new ExpandingSearch("Search")
					)
				]
			)
		);
	}
}
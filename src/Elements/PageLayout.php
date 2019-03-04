<?php

namespace Elements;

use \Rossato\Element;
use \Elements\Header\Header;
use \Elements\Header\Drawer;
use \Elements\LoadingPageContent;

class PageLayout extends Element {
	public function __construct($config) {
		parent::__construct(
			"div",
			["class" => "mdl-layout mdl-js-layout mdl-layout--fixed-header"],
			[
				new Header($config),
				new Drawer($config),
				new LoadingPageContent($config)
			]
		);
	}
}
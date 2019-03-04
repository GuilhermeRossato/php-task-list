<?php

namespace Elements;

use \Rossato\Element;

use \Elements\Material\LoadingSpinner;

class LoadingPageContent extends Element {
	public function __construct($config) {
		parent::__construct(
			"main",
			["class" => "mdl-layout__content", "style" => "background-color:#f4f4f4;"],
			new Element(
				"div",
				["class"=>"page-content flex-center"],
				new LoadingSpinner(["radius" => 50, "single-color" => true])
			)
		);
	}
}
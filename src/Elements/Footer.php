<?php

namespace Elements;

use \Rossato\Element;

class Footer extends Element {
	public function __construct($config) {
		$this->element = new Element("footer", ["class"=>"footer"]);
		parent::__construct("div", ["class"=>"footer-wrapper"]);
		$this->add($this->element);
	}
}
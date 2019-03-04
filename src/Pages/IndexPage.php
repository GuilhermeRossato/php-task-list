<?php

namespace Pages;

use \Rossato\Page;
use \Rossato\Element;

use \Pages\AbstractPage;
use \Elements\PageLayout;

class IndexPage extends AbstractPage {
	public function __construct($config) {
		parent::__construct($config);
		$this->body->add(new PageLayout($config));
		$this->body->add(new Element(
			"script",
			[],
			"window.appRoot = ".json_encode($config["url-prefix"])
		));
	}
}
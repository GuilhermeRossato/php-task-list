<?php

namespace Pages;

use \Rossato\Page;
use \Rossato\Element;
use \Elements\HTMLHeader;

class AbstractPage extends Page {
	public function __construct($config) {
		parent::__construct();
		HTMLHeader::wrap($this->head, $config);
	}
}
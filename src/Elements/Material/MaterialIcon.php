<?php

namespace Elements\Material;

use \Rossato\Element;
use \Elements\Material\MaterialIcon;

class MaterialIcon extends Element {
	public function __construct($icon) {
		parent::__construct(
			"i",
			["class" => "material-icons"],
			$icon
		);
	}
}
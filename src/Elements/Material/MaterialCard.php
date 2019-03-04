<?php

namespace Elements\Material;

use \Rossato\Element;

class MaterialCard extends Element {
	public function __construct($config) {
		parent::__construct(
			"div",
			["class" => "mdl-card mdl-shadow--2dp", "style" => "min-height: auto"]
		);
		if ($config["title"]) {
			$this->add(
				new Element(
					"div",
					["class" => "mdl-card__title"],
					new Element(
						"h2",
						["class" => "mdl-card__title-text"],
						$config["title"]
					)
				)
			);
		}
		if ($config["content"]) {
			$this->add(
				new Element(
					"div",
					["class" => "mdl-card__supporting-text"],
					$config["content"]
				)
			);
		}
		if ($config["actions"]) {
			$this->add(
				new Element(
					"div",
					["class" => "mdl-card__actions mdl-card--border"],
					$config["actions"]
				)
			);
		}
		if ($config["style"]) {
			$this->setAttribute("style", $config["style"]);
		}
		if ($config["class"]) {
			$this->setAttribute("class", $this->getAttribute("class")." ".$config["class"]);
		}
	}
}
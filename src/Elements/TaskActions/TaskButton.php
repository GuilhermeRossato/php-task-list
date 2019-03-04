<?php

namespace Elements\TaskActions;

use \Rossato\Element;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialIcon;

use \URL;

class TaskButton extends Element {
	public function __construct($config) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}

		parent::__construct(
			"span",
			["class" => "task-button"],
			new MaterialButton([
				"icon" => "simple",
				"content" => new MaterialIcon($config["icon"]),
				"href" => $config["url"],
				"alt" => $config["alt"]
			])
		);
	}
}
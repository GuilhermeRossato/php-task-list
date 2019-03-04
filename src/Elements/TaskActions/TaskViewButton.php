<?php

namespace Elements\TaskActions;

use \Rossato\Element;

use \URL;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialIcon;
use \Elements\TaskActions\TaskButton;

class TaskViewButton extends TaskButton {
	public function __construct($config, $task) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}

		$id = array_key_exists("id", $task)?$task["id"]:"??";

		$rootUrl = $config["url-prefix"];
		$viewUrl = URL::concat($rootUrl, $config["routes"]["task-view-url"]);
		$fullViewUrl = URL::concat($viewUrl, $id);

		parent::__construct([
			"icon" => "remove_red_eye",
			"url" => $fullViewUrl,
			"alt" => "View Task"
		]);
	}
}
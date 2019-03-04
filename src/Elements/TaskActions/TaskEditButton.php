<?php

namespace Elements\TaskActions;

use \Rossato\Element;

use \URL;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialIcon;
use \Elements\TaskActions\TaskButton;

class TaskEditButton extends TaskButton {
	public function __construct($config, $task) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}

		$id = array_key_exists("id", $task)?$task["id"]:"??";

		$rootUrl = $config["url-prefix"];
		$editUrl = URL::concat($rootUrl, $config["routes"]["task-edit-url"]);
		$fullEditUrl = URL::concat($editUrl, $id);

		parent::__construct([
			"icon" => "edit",
			"url" => $fullEditUrl,
			"alt" => "Edit Task"
		]);
	}
}
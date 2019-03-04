<?php

namespace Elements\TaskActions;

use \Rossato\Element;

use \URL;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialIcon;
use \Elements\TaskActions\TaskButton;

class TaskDeleteButton extends TaskButton {
	public function __construct($config, $task) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}

		$id = array_key_exists("id", $task)?$task["id"]:"??";

		$rootUrl = $config["url-prefix"];
		$deleteUrl = URL::concat($rootUrl, $config["routes"]["task-delete-url"]);
		$fullDeleteUrl = URL::concat($deleteUrl, $id);

		parent::__construct([
			"icon" => "delete",
			"url" => $fullDeleteUrl,
			"alt" => "Delete Task"
		]);
	}
}
<?php

namespace Elements\TaskList;

use \Rossato\Element;
use \Elements\TaskList\TaskActions;

use \Elements\TaskActions\TaskViewButton;
use \Elements\TaskActions\TaskEditButton;
use \Elements\TaskActions\TaskDeleteButton;

class Task extends Element {
	public function __construct($config, $task) {
		if (!$config) {
			throw new Exception("Missing configuration from Task");
		}
		$id = array_key_exists("id", $task)?$task["id"]:"??";
		$state = array_key_exists("state", $task)?$task["state"]:"??";
		$name = array_key_exists("name", $task)?$task["name"]:"??";
		parent::__construct(
			"tr",
			["class" => ($state === "checked") ? "is-selected" : ""],
			[
				new Element(
					"td",
					[],
					[
						new TaskViewButton($config, $task),
						new TaskEditButton($config, $task)
					]
				),
				new Element(
					"td",
					["class" => "id mdl-data-table__cell--non-numeric"],
					$name
				),
				new Element(
					"td",
					[],
					new TaskDeleteButton($config, $task)
				),
			]
		);
	}
}
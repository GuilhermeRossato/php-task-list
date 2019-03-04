<?php

namespace Elements\TaskList;

use \Rossato\Element;

use \Elements\TaskList\TaskListTable;

use \Elements\Material\MaterialCard;

class TaskListBlock extends Element {
	public function __construct($config) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}

		parent::__construct(
			"div",
			["class" => "task-list-block"],
			new MaterialCard([
				"title" => "Task List",
				"style" => "width: auto;",
				"content" => [
					new TaskListTable($config)
				]
			])
		);
	}
}
<?php

namespace Elements\TaskList;

use \Rossato\Element;

use \Elements\TaskList\Task;

class TaskListBody extends Element {
	public function __construct($config, $tasks) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}
		if (!$tasks || !is_array($tasks)) {
			throw new Exception("Task list must be sent as array, got ", gettype($tasks));
		}

		parent::__construct(
			"tbody",
			[],
			array_map(function($task) use ($config) { return new Task($config, $task); }, $tasks)
		);
	}
}
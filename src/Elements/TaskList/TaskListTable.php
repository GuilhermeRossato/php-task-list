<?php

namespace Elements\TaskList;

use \Rossato\Element;

use \Elements\EmptyListMessage;
use \Commands\LoadTaskCommand;
use \Commands\GetTaskLengthCommand;

use \Elements\TaskList\TaskListHeader;
use \Elements\TaskList\TaskList;

use \Elements\Material\MaterialDataTable;

use \URL;

class TaskListTable extends Element {
	public function tasksToTable($config, $tasks) {
		if (count($tasks) === 0) {
			return new EmptyListMessage($config);
		}
		$total = $config["total"];
		$rootDir = $config["url-prefix"];
		$viewTasksDir = $config["routes"]["navigation"]["task-list"]["href"];
		$nextPageUrl = URL::concat($rootDir, $viewTasksDir);
		return new MaterialDataTable([
			"head" => new TaskListHeader($config),
			"body" => new TaskListBody($config, $tasks),
			"pagination" => [
				"next-page-url" => $nextPageUrl,
				"offset" => $config["offset"],
				"limit" => $config["limit"],
				"total" => $total,
				"next-page-url" => ($config["page"] == $config["total-pages"])?"":"/page/".($config["page"]+1)."/",
				"last-page-url" => ($config["page"] <= 0)?"":"/page/".($config["page"]-1)."/"
			]
		]);
	}

	public function __construct($config) {
		$connection = $config["connection"];

		$loader = new GetTaskLengthCommand($connection);
		$total = $loader->execute();

		$config["page"] = array_key_exists("page", $config)?$config["page"]:0;
		$config["limit"] = 2;
		$config["offset"] = $config["page"]*$config["limit"];
		$config["total"] = $total;
		$config["total-pages"] = floor($total/$config["limit"]);

		$loader = new LoadTaskCommand($connection);
		$data = $loader->execute([
			"offset" => $config["offset"],
			"limit" => $config["limit"]
		]);

		parent::__construct(
			"div",
			["class" => "task-list-wrapper"],
			$this->tasksToTable($config, $data)
		);
	}
}
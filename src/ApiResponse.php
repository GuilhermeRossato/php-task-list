<?php

use \Rossato\Element;

use \Elements\TaskList\TaskListBlock;
use \Elements\NewTaskForm;
use \Elements\RawData\RawDataForm;

class ApiResponse extends Element {
	public function __construct($config) {
		if (!$config["connection"]) {
			throw new Exception("Missing 'connection' from parameter");
		}
		$apiUrl = $config["api-url"];
		parent::__construct("div",["class" => "api-response", "target" => $apiUrl]);
		if ($apiUrl === "/" || strpos($apiUrl, "/page/") === 0) {
			if (strpos($apiUrl, "/page/") === 0) {
				$num = preg_replace("/[^0-9]/", "", substr($apiUrl, 5));
				$config["page"] = $num;
			} else {
				$config["page"] = 0;
			}
			$this->add(new TaskListBlock($config));
		} else if ($apiUrl === "/new-task/") {
			$this->add(new NewTaskForm($config));
		} else if ($apiUrl === "/raw-data/") {
			$this->add(new RawDataForm($config));
		} else {
			$this->add("No route for \"".$apiUrl."\"");
		}
	}
}
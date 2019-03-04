<?php

use \Commands\SaveTaskCommand;

class ApiExecute {
	public function __construct($config) {
		if (!$config["connection"]) {
			throw new Exception("Missing valid connection");
		}
		if (!$config["data"]) {
			throw new Exception("Missing valid data object");
		}
		$url = $config["api-url"];
		if ($url === "/save-task/") {
			$this->result = $this->executeSaveTask($config["connection"], $config["data"]);
		} else {
			$this->result = "Error: Unknown api endpoint: ".$url;
		}
	}

	public function executeSaveTask($connection, $data) {
		if (!$connection) {
			throw new Exception("Missing valid connection");
		}
		$saver = new SaveTaskCommand($connection, $data);
		$saver->execute();
		return "OK";
	}

	public function __toString() {
		return (string)$this->result;
	}
}
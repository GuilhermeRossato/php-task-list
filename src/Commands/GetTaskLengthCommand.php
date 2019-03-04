<?php

namespace Commands;

class GetTaskLengthCommand {
	public function __construct($connection) {
		if (!$connection || !method_exists($connection, "get")) {
			throw new \Exception("Missing valid connection");
		}
		$this->connection = $connection;
	}

	public function execute($config=[]) {
		$data = $this->connection->get("tasks");

		if (!$data) {
			return 0;
		}

		try {
			$obj = json_decode($data, true);
		} catch (Exception $err) {
			return 0;
		}

		if (!isset($obj) || !$obj) {
			return 0;
		}

		return count($obj);
	}
}
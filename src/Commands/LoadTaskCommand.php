<?php

namespace Commands;

class LoadTaskCommand {
	public function __construct($connection) {
		if (!$connection || !method_exists($connection, "get")) {
			throw new \Exception("Missing valid connection");
		}
		$this->connection = $connection;
	}

	public function execute($config=[]) {
		$data = $this->connection->get("tasks");

		if (!$data) {
			$data = [];
		} else {
			try {
				$data = json_decode($data, true);
			} catch (Exception $err) {
			}
			if (!isset($data) || !$data) {
				$data = [];
			}
		}

		if (!array_key_exists("offset", $config) && !array_key_exists("limit", $config)) {
			return $data;
		}

		$filtered = [];

		$index = 0;
		$count = 0;
		$offset = $config["offset"];
		$limit = min([16, $config["limit"]]);

		foreach ($data as $key=>$value) {
			if ($index >= $offset) {
				if ($count >= $limit) {
					break;
				}
				$filtered[$key] = $value;
				$count += 1;
			}
			$index += 1;
		}

		return $filtered;
	}
}
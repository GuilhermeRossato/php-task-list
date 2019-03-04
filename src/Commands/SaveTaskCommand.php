<?php

namespace Commands;

use \Commands\LoadTaskCommand;

class SaveTaskCommand {
	public function __construct($connection, $data) {
		if (!$connection || !method_exists($connection, "set")) {
			throw new \Exception("Missing valid connection");
		}
		if (!$data || !is_array($data)) {
			throw new \Exception("Missing valid data");
		}
		$this->connection = $connection;
	}

	public function execute($config = []) {
		$loader = new LoadTaskCommand($this->connection);
		$all_data = $loader->execute();

		$state = "unchecked";
		if (array_key_exists("checked", $config)) {
			$state = ($config["checked"]==="true" || $config["checked"] === "checked" || $config["checked"]===true)?"checked":"unchecked";
		} else {
			$state = "unchecked";
		}

		$is_new_task = !$config["id"];

		if ($is_new_task) {
			$id = self::get_unique_id(trim($config["name"]), $all_data);
		}

		$all_data[$id] = [
			"id" => $id,
			"name" => $config["name"],
			"description" => $config["short-description"],
			"state" => $state,
			"modified-date" => new \DateTime()
		];

		if ($is_new_task) {
			$all_data[$id]["creation-date"] = new \DateTime();
		}

		$this->connection->set("tasks", json_encode($all_data));
		return true;
	}

	static public function get_unique_id($name, $data) {
		$name = self::slugify($name);
		$num = "";
		while ($data[$name.$num]) {
			if (!$num) {
				$num = 2;
			} else {
				if ($num > 100) {
					throw new Exception("Exausted unique id generation");
				} else {
					$num += 1;
				}
			}
		}
		return $name.$num;
	}

	static public function slugify($text) {
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}
}
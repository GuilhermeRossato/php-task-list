<?php

namespace Elements\TaskList;

use \Rossato\Element;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialIcon;

use \URL;

class TaskActions extends Element {
	public function __construct($config, $task) {
		if (!$config) {
			throw new Exception("Missing configuration");
		}
		$id = array_key_exists("id", $task)?$task["id"]:"??";

		$rootUrl = $config["url-prefix"];
		$openUrl = URL::concat($rootUrl, $config["routes"]["task-open-url"]);
		$editUrl = URL::concat($rootUrl, $config["routes"]["task-edit-url"]);
		$removeUrl = URL::concat($rootUrl, $config["routes"]["task-remove-url"]);

		$fullOpenUrl = URL::concat($openUrl, $id);
		$fullEditUrl = URL::concat($editUrl, $id);
		$fullRemoveUrl = URL::concat($removeUrl, $id);

		parent::__construct(
			"td",
			["class" => "actions"],
			[
				new MaterialButton([
					"icon" => "simple",
					"content" => new MaterialIcon("remove_red_eye"),
					"href" => $fullOpenUrl
				]),
				new MaterialButton([
					"icon" => "simple",
					"content" => new MaterialIcon("edit"),
					"href" => $fullEditUrl
				]),
				new MaterialButton([
					"icon" => "simple",
					"content" => new MaterialIcon("delete"),
					"href" => $fullRemoveUrl
				])
			]
		);
	}
}
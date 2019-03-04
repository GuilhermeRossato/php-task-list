<?php

namespace Elements;

use \Rossato\Element;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialCard;
use \URL;

class EmptyListMessage extends Element {
	public function __construct($config) {
		$hasRoute = ($config && $config["routes"] && $config["routes"]["new-task"]);
		$taskRoute = $hasRoute?URL::concatenate($config["url-prefix"], $config["routes"]["new-task"]):"";

		$button = new MaterialButton([
			"flat" => "true",
			"content" => "New Task",
			"href" => $taskRoute
		]);

		parent::__construct(
			"div",
			["class" => "flex-center"],
			new MaterialCard([
				"title" => "Empty Task List",
				"content" => "You currently don't have any registered tasks.",
				"actions" => $button
			])
		);
	}
}
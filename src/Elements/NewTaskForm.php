<?php

namespace Elements;

use \Rossato\Element;
use \Elements\Material\MaterialCard;
use \Elements\Material\MaterialButton;
use \Elements\Material\MaterialTextInput;
use \Elements\Material\MaterialCheckbox;
use \Elements\Material\MaterialIcon;

class NewTaskForm extends Element {
	public function __construct($config) {
		$groups = [
			new Element(
				"div",
				["class" => "input-group"],
				new MaterialTextInput(["label" => "Name"])
			),
			new Element(
				"div",
				["class" => "input-group"],
				new MaterialTextInput(["label" => "Short Description"])
			),
			new Element("div",["class" => "errors", "style" => "color:red"])
		];
		parent::__construct(
			"form",
			[
				"class" => "new-task-form",
				"autocomplete" => "off",
				"action" => $config["routes"]["task-list"]
			],
			new MaterialCard([
				"title" => "New Task",
				"content" => $groups,
				"actions" => [
					new MaterialButton([
						"content" => "Cancel",
						"flat" => true,
						"onclick" => "history.back();event.preventDefault();"
					]),
					new MaterialButton([
						"content" => "Create",
						"flat" => true,
						"onclick" => "return new_task_click(event);"
					])
				]
			])
		);
	}
}
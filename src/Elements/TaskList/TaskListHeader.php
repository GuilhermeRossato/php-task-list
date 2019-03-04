<?php

namespace Elements\TaskList;

use \Rossato\Element;

class TaskListHeader extends Element {
	public function __construct($config) {
		parent::__construct(
			"tr",
			[],
			[
				new Element("th", ["style" => "text-align:center"], "Actions"),
				new Element("th", ["class" => "mdl-data-table__cell--non-numeric"], "Description"),
				new Element("th", [], "Delete")
			]
		);
	}
}
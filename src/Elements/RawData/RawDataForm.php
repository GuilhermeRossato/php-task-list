<?php

namespace Elements\RawData;

use \Rossato\Element;
use \Commands\LoadTaskCommand;
use \Elements\Material\MaterialCard;
use \URL;

class RawDataForm extends Element {
	public function __construct($config) {
		$loader = new LoadTaskCommand($config["connection"]);
		$data = $loader->execute();

		parent::__construct(
			"form",
			[
				"action" => URL::concat($config["app-root"], "/raw-form/")
			],
			new MaterialCard([
				"title" => "Raw Data Form",
				"content" => [
					new Element("p", [], "Here we can see the raw data content on the 'backend'"),
					new Element("pre", [], json_encode($data, JSON_PRETTY_PRINT))
				],
				"style" => "width: auto"
			])
		);
	}
}
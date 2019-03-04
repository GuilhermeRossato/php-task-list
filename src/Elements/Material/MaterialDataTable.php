<?php

namespace Elements\Material;

use \Rossato\Element;

use \Elements\EmptyListMessage;
use \Commands\LoadTaskCommand;

class MaterialDataTable extends Element {
	public function __construct($config) {
		parent::__construct(
			"table",
			["class" => "mdl-data-table mdl-js-data-table mdl-data-table--selectable"]
		);

		foreach (["head", "body", "foot"] as $contentType) {
			if (!array_key_exists($contentType, $config) || !$config[$contentType]) {
				continue;
			}
			$configContent = $config[$contentType];
			if ($configContent) {
				if (is_object($configContent) && $configContent->tag === "t".$contentType) {
					$this->add($configContent);
				} else {
					$this->add(new Element("t".$contentType, [], $configContent));
				}
			}
		}

		if (!$config["foot"] && $config["pagination"]) {
			$navConfig = $config["pagination"];

			$nextPageUrl = array_key_exists("next-page-url", $navConfig)?$navConfig["next-page-url"]:false;
			$lastPageUrl = array_key_exists("last-page-url", $navConfig)?$navConfig["last-page-url"]:false;

			$leftIcon = new MaterialIcon("chevron_left");
			$leftButton = new MaterialButton(["icon" => "simple","content" => $leftIcon]);
			if ($lastPageUrl) {
				$leftButton->setAttribute("href", $lastPageUrl);
			} else {
				$leftIcon->setAttribute("style", "color: rgba(0, 0, 0, 0.26);");
			}

			$rightIcon = new MaterialIcon("chevron_right");
			$rightButton = new MaterialButton(["icon" => "simple","content" => $rightIcon]);
			if ($nextPageUrl) {
				$rightButton->setAttribute("href", $nextPageUrl);
			} else {
				$rightIcon->setAttribute("style", "color: rgba(0, 0, 0, 0.26);");
			}

			$offset = $navConfig["offset"];
			$limit = $navConfig["limit"];
			$offsetEnd = min([$offset+$limit, $navConfig["total"]]);
			$labelText = ($offset+1)."-".$offsetEnd;
			if (array_key_exists("total", $navConfig)) {
				$labelText .= " out of ".$navConfig["total"];
			}
			$tfoot = new Element("tfoot");
			$tfoot->add("tr");

			$this->add(
				new Element(
					"tfoot",
					[],
					new Element(
						"tr",
						[],
						new Element(
							"td",
							["colspan" => "100"],
							[
								new Element("pre", ["style" => "display:inline;margin-right:20px"], $labelText),
								$leftButton,
								$rightButton
							]
						)
					)
				)
			);
		}

		if ($config["style"]) {
			$this->setAttribute("style", $config["style"]);
		}

		if ($config["class"]) {
			$this->setAttribute("class", $this->getAttribute("class")." ".$config["class"]);
		}
	}
}
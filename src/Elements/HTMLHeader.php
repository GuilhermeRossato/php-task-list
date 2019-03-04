<?php

namespace Elements;

use \Rossato\Element;
use \URL;

class HTMLHeader extends Element {
	public function __construct($config) {
		parent::__construct(
			"head"
		);
		self::wrap($this, $config);
	}

	private static function searchForFileExtension($directory, &$array, $extension=".dat") {
		if (!$directory) {
			return false;
		}
		if (substr($directory, -1) === "/" || substr($directory, -1) === "\\") {
			$directory = substr($directory, strlen($directory)-1);
		}
		$nodes = scandir($directory);
		if (is_array($nodes)) {
			foreach ($nodes as $node) {
				if ($node[0] === "." || $node === "vendor") continue;
				$node = $directory.DIRECTORY_SEPARATOR.$node;
				if (is_dir($node)) {
					self::searchForFileExtension($node, $array, $extension);
				} else if (substr($node, -strlen($extension)) === $extension) {
					array_push($array, $node);
				}
			}
		}
	}

	public static function addStyles($head, $config) {
		$appRoot = $config["app-root"];

		$styles = [];
		self::searchForFileExtension($appRoot, $styles, ".css");

		foreach ($styles as $path) {
			$url = str_replace("\\", "/", substr($path, strlen($appRoot)));
			$path = URL::concatenate($config["url-prefix"], $url);
			$head->add(new Element("link", ["rel" => "stylesheet", "href" => $path]));
		}
	}

	public static function addScripts($head, $config) {
		$appRoot = $config["app-root"];

		$scripts = [];
		self::searchForFileExtension($appRoot, $scripts, ".js");

		foreach ($scripts as $path) {
			$url = str_replace("\\", "/", substr($path, strlen($appRoot)));
			$path = URL::concatenate($config["url-prefix"], $url);
			$head->add(new Element("script", ["src" => $path]));
		}
	}

	public static function addAssets($head, $config) {
		self::addStyles($head, $config);
		self::addScripts($head, $config);
	}

	public static function wrap($head, $config) {
		if (!($head instanceof Element) || $head->tag !== "head") {
			throw new Exception("Can only wrap a head element");
		}

		$head->add(new Element("meta", ["charset" => "utf-8"]));
		$head->add(new Element("meta", [
			"name" => "viewport",
			"content" => "width=device-width,initial-scale=1,user-scalable=no"
		]));

		self::addAssets($head, $config);

		$head->add(new Element("title", [], $config["header"]["title"]));
	}
}
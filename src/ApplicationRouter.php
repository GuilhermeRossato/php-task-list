<?php

use Pages\IndexPage;

class ApplicationRouter {
	public function __construct($config) {
		$this->config = $config;
		$this->url = strtolower(explode("?",$_SERVER["REQUEST_URI"])[0]);
		$is_api = (strpos($this->url, "/api/") !== false);
		$this->api_url = $is_api?substr($this->url, strpos($this->url, "/api/")+4):false;
		$this->result = ($this->api_url)?$this->routeApi():$this->routeIndex();
	}

	public function routeApi() {
		$connection = new Connection();
		$this->config["connection"] = $connection;
		$this->config["api-url"] = $this->api_url;
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			$this->config["data"] = $_POST;
			$execution = new ApiExecute($this->config);
		} else {
			$execution = new ApiResponse($this->config);
		}

		return (string) $execution;
	}

	public function routeIndex() {
		$this->config["url"] = $this->url;
		return (string) new IndexPage($this->config);
	}

	public function __toString() {
		return (string) $this->result;
	}
}
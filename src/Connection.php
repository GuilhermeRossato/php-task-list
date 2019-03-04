<?php

class Connection {
	public function __construct() {
		$this->storage = new Memcache();
		$this->prefix = preg_match("/^[a-zA-Z0-9]+$/", array_key_exists("REMOTE_ADDR", $_SERVER)?$_SERVER["REMOTE_ADDR"]:"unknown");
	}

	public function transformKey($key) {
		return $this->prefix.preg_match("/^[a-zA-Z0-9]+$/",$key);
	}

	public function get($key) {
		return $this->storage->get($this->transformKey($key));
	}

	public function set($key, $value) {
		return $this->storage->set($this->transformKey($key), $value);
	}
}
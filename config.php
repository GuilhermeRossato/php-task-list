<?php

$config = [
	"url-prefix" => "/",
	"app-root" => __DIR__,
	"header" => [
		"title" => "Task List",
	],
	"routes" => [
		"new-task" => "/new-task/",
		"task-open-url" => "/task/",
		"task-edit-url" => "/task/edit/",
		"task-remove-url" => "/task/remove/",
		"navigation" => [
			"task-list" => ["name" => "Task List", "href" => "/"],
			"new-task" => ["name" => "New Task", "href" => "/new-task/"],
			"raw-data" => ["name" => "Raw Data", "href" => "/raw-data/"]
		]
	]
];

$env = strtoupper(getenv("ENVIRONMENT"));

if ($env === "PRODUCTION") {
	$config["PRODUCTION"] = true;
}

return $config;
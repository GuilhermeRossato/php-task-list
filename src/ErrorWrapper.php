<?php

use \Rossato\Element;

class ErrorWrapper {
	public function __construct($errors, $success) {
		if (count($errors)) {
			return new Element(
				"ul",
				["class"=>"message error"],
				array_map(function($element) {
					return new Element(
						"li",
						[],
						$element
					)
				}, $errors);
			)
		} else {
			if (is_callable($success)) {
				try {
					return $success();
				} catch ($err) {
					return new ErrorWrapper(["PHP Error:".$err], null);
				}
			} else {
				return $success;
			}
		}
	}
}
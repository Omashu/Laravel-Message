<?php

namespace Omashu\Message;

trait MessageTrait {
	public function setMessage($value) {
		$this->message = $value;
		return $this;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setType($value) {
		$this->type = $value;
		return $this;
	}

	public function getType() {
		return $this->type;
	}
}
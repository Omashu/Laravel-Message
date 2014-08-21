<?php namespace Omashu\Message;

class Factory {
	protected static $messages = array();

	public function add($message, $type = '') {
		$object = new Message();
		$object->setMessage($message);
		$object->setType($type);
		return $object;
	}
}
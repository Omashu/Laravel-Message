<?php namespace Omashu\Message;

class Message {
	use MessageTrait;

	protected $message = NULL;
	protected $type = NULL;
	protected $tags = array();
}
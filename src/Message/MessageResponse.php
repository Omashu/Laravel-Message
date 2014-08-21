<?php namespace Omashu\Message;

class MessageResponse {
	protected $grouped = false;
	protected $sorted = false;
	protected $messages = array();

	public function __construct(array $messages = array(), $grouped = false, $sorted = false)
	{
		$this->grouped = (bool) $grouped;
		$this->sorted = (bool) $sorted;
		$this->messages = $messages;
	}

	public function messages()
	{
		return $this->messages;
	}

	public function grouped()
	{
		return $this->grouped;
	}

	public function sorted()
	{
		return $this->sorted;
	}
}
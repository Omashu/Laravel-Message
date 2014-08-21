<?php namespace Omashu\Message;

/**
 * Message manager
 */
class Manager {

	/**
	 * All messages
	 * 
	 * @var array
	 */
	protected $messages = array();

	/**
	 * Create custom message
	 * 
	 * @param string $message
	 * @param mixed $type
	 * @return Omashu\Message\Message
	 */
	public function create($message = NULL, $type = NULL)
	{
		$object = new Message();
		$object->setMessage($message);
		$object->setType($type);

		$this->messages[] = $object;

		return $object;
	}

	/*** FAST CREATE MESSAGE ***/
	public function info($value)
	{
		return $this->create($value, "info");
	}

	public function success($value)
	{
		return $this->create($value, "success");
	}

	public function danger($value)
	{
		return $this->create($value, "danger");
	}

	public function warning($value)
	{
		return $this->create($value, "warning");
	}

	public function getAll()
	{
		return $this->messages;
	}
}
<?php namespace Omashu\Message;

/**
 * Message response manager
 */
class MessageResponse {

	/**
	 * @var bool Stack messages grouped by type
	 */
	protected $grouped = false;

	/**
	 * @var bool Stack messages sorted by priority
	 */
	protected $sorted = false;

	/**
	 * @var array Messages
	 */
	protected $messages = array();

	/**
	 * Constructor
	 * 
	 * @param array $messages
	 * @param bool $grouped
	 * @param bool $sorted
	 */
	public function __construct(array $messages = array(), $grouped = false, $sorted = false)
	{
		$this->grouped = (bool) $grouped;
		$this->sorted = (bool) $sorted;
		$this->messages = $messages;
	}

	/**
	 * Get messages
	 * @return array
	 */
	public function messages()
	{
		return $this->messages;
	}

	/**
	 * Get is grouped
	 * @return bool
	 */
	public function grouped()
	{
		return $this->grouped;
	}

	/**
	 * Get is sorted
	 * @return bool
	 */
	public function sorted()
	{
		return $this->sorted;
	}
}
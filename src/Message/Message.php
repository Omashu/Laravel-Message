<?php namespace Omashu\Message;

/**
 * Message entity
 */
class Message {
	use MessageTrait;

	/**
	 * @var string message
	 */
	protected $message = NULL;

	/**
	 * @var string message type (success|danger|custrom string)
	 */
	protected $type = NULL;

	/**
	 * @var array message tags
	 */
	protected $tags = array();

	/**
	 * @var int message priority
	 */
	protected $priority = 100;
}
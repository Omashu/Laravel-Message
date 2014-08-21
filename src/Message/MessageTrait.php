<?php
namespace Omashu\Message;

/**
 * Message working methods
 */
trait MessageTrait {

	/**
	 * Set message
	 * @param string $value
	 * @return this
	 */
	public function setMessage($value)
	{
		$this->message = (string) $value;
		return $this;
	}

	/**
	 * Get message
	 * @param bool $e use htmlentities
	 * @return string
	 */
	public function getMessage($e = true)
	{
		return $e
			? e($this->message)
			: $this->message;
	}

	/**
	 * Set message type
	 * @param string $value (info|danger|success|myalert)
	 * @return this
	 */
	public function setType($value)
	{
		$this->type = (string) $value;
		return $this;
	}

	/**
	 * Get message type
	 * @param bool $e use htmlentities
	 * @return string
	 */
	public function getType($e = true)
	{
		return $e
			? e($this->type)
			: $this->type;
	}

	/**
	 * Append new tag in stack
	 * @param string $value
	 * @return this
	 */
	public function appendTag($value)
	{
		if (in_array($value, $this->tags))
		{
			return $this;
		}

		$this->tags[] = $value;
		return $this;
	}

	/**
	 * Remove tag
	 * @param string $value tag name
	 * @return this
	 */
	public function removeTag($value)
	{
		$key = array_search($value, $this->tags);
		if ($key !== false)
		{
			unset($this->tags[$key]);
		}

		return $this;
	}

	/**
	 * Remove all tags
	 * @return this
	 */
	public function removeTags()
	{
		$this->tags = array();
		return $this;
	}

	/**
	 * Get message tags
	 * @param null|string $implode
	 * @return array|string
	 */
	public function getTags($implode = null)
	{
		return is_string($implode)
		? implode($implode, $this->tags) : $this->tags;
	}

	/**
	 * Set message priority
	 * @param int $value
	 * @return this
	 */
	public function setPriority($value)
	{
		$this->priority = (int) $value;
		return $this;
	}

	/**
	 * Get message priority
	 * @return int
	 */
	public function getPriority()
	{
		return $this->priority;
	}
}
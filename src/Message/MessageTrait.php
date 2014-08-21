<?php

namespace Omashu\Message;

trait MessageTrait {

	public function setMessage($value)
	{
		$this->message = $value;
		return $this;
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function setType($value)
	{
		$this->type = $value;
		return $this;
	}

	public function getType()
	{
		return $this->type;
	}

	public function appendTag($value)
	{
		$this->tags[] = $value;
		return $this;
	}

	public function removeTag($value)
	{
		$key = array_search($value, $this->tags);
		if ($key !== false)
		{
			unset($this->tags[$key]);
		}

		return $this;
	}

	public function removeTags()
	{
		$this->tags = array();
		return $this;
	}

	public function getTags($implode = NULL)
	{
		return is_string($implode)
		? implode($implode, $this->tags) : $this->tags;
	}

	public function setPriority($value)
	{
		$this->priority = (int) $value;
		return $this;
	}

	public function getPriority()
	{
		return $this->priority;
	}
}
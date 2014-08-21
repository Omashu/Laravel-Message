<?php namespace Omashu\Message;

use Illuminate\View\Factory as ViewFactory;

/**
 * Message manager
 */
class Manager {

	/**
	 * The view factory instance.
	 *
	 * @var \Illuminate\View\Factory
	 */
	protected $view;

	/**
	 * All messages
	 * 
	 * @var array
	 */
	protected $messages = array();

	public function __construct(ViewFactory $view)
	{
		$this->view = $view;
		$this->view->addNamespace('message', __DIR__.'/views');
	}

	/**
	 * Create custom message
	 * 
	 * @param string $message
	 * @param string $type
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

	/*** GETTERS ***/
	public function get($group = TRUE, $sort = TRUE)
	{
		return $this->_get($this->messages, $group, $sort);
	}

	public function getSuccess($sort = TRUE)
	{
		return $this->_get($this->_getByType("success"), FALSE, $sort);
	}

	public function getInfo($sort = TRUE)
	{
		return $this->_get($this->_getByType("info"), FALSE, $sort);
	}

	public function getDanger($sort = TRUE)
	{
		return $this->_get($this->_getByType("danger"), FALSE, $sort);
	}

	public function getWarning($sort = TRUE)
	{
		return $this->_get($this->_getByType("warning"), FALSE, $sort);
	}

	public function render()
	{
		return $this->view->make("message", array("messages" => $this->get()));
	}

	/*** HELPERS ***/
	protected function _get(array $messages, $group = TRUE, $sort = TRUE)
	{
		if (!$group AND !$sort)
		{
			return $messages;
		}

		$results = array();

		if ($group)
		{
			foreach ($messages as $message)
			{
				if ($sort)
				{
					$results[$message->getType()][$message->getPriority()][] = $message;
					continue;
				}

				$results[$message->getType()][] = $message;
			}
		} else if ($sort)
		{
			foreach ($messages as $message)
			{
				$results[$message->getPriority()][] = $message;
			}
		}

		if ($sort AND !$group)
		{
			ksort($results);
		} else if ($sort AND $group)
		{
			foreach ($results as $group => $values)
			{
				ksort($results[$group]);
			}
		}

		return $results;
	}

	protected function _getByType($type)
	{
		$messages = array();
		foreach ($this->messages as $message)
		{
			if ($message->getType() !== $type)
			{
				continue;
			}

			$messages[] = $message;
		}

		return $messages;
	}
}
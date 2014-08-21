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
	public function create($message = null, $type = null)
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
	public function get($group = true, $sort = true)
	{
		return $this->_get($this->messages, $group, $sort);
	}

	public function getSuccess($sort = true)
	{
		return $this->_get($this->_getByType("success"), false, $sort);
	}

	public function getInfo($sort = true)
	{
		return $this->_get($this->_getByType("info"), false, $sort);
	}

	public function getDanger($sort = true)
	{
		return $this->_get($this->_getByType("danger"), false, $sort);
	}

	public function getWarning($sort = true)
	{
		return $this->_get($this->_getByType("warning"), false, $sort);
	}

	public function getView($viewName = null, array $messages = null)
	{
		$viewName = is_null($viewName) ? "message::message" : $viewName;
		$messages = is_null($messages) ? $this->get() : $messages;

		return $this->view->make($viewName, array("messages" => $messages));
	}

	/*** HELPERS ***/
	protected function _get(array $messages, $group = true, $sort = true)
	{
		$group = (bool) $group;
		$sort = (bool) $sort;

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
			foreach ($results as $type => $values)
			{
				ksort($results[$type]);
			}
		}

		return new MessageResponse($results, $group, $sort);
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
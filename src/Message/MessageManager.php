<?php namespace Omashu\Message;

use Illuminate\View\Factory as ViewFactory;
use Illuminate\Session\SessionManager;
use Illuminate\Validation\Validator;

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
	 * The session manager instance.
	 *
	 * @var \Illuminate\Session\SessionManager
	 */
	protected $session;

	/**
	 * Session name
	 */
	protected $sessionName = "messages";

	/**
	 * All messages
	 * 
	 * @var array
	 */
	protected $messages = array();

	/**
	 * Constructor (singleton)
	 */
	public function __construct(ViewFactory $view, SessionManager $session)
	{
		$this->view = $view;
		$this->view->addNamespace('message', __DIR__.'/views');

		$this->session = $session;
		$this->messages = $this->session->get($this->sessionName, array());
	}

	/**
	 * Get session name, where the messages are stored
	 * @return string
	 */
	public function getSessionName()
	{
		return $this->sessionName;
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
		if ($message instanceof Validator)
		{
			$messages = array();
			foreach ($message->messages()->getMessages() as $field => $values)
			{
				foreach ($values as $str)
				{
					$object = $this->create($str, $type);
					$object->appendTag($field);

					$messages[] = $object;
				}
			}

			return $messages;
		}

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

	public function getSuccess($group = true, $sort = true)
	{
		return $this->_get($this->_getByType("success"), $group, $sort);
	}

	public function getInfo($group = true, $sort = true)
	{
		return $this->_get($this->_getByType("info"), $group, $sort);
	}

	public function getDanger($group = true, $sort = true)
	{
		return $this->_get($this->_getByType("danger"), $group, $sort);
	}

	public function getWarning($group = true, $sort = true)
	{
		return $this->_get($this->_getByType("warning"), $group, $sort);
	}

	public function getView($viewName = null, MessageResponse $response = null)
	{
		$viewName = is_null($viewName) ? "message::message" : $viewName;
		$response = is_null($response) ? $this->get() : $response;

		return $this->view->make($viewName, array("result" => $response));
	}

	public function getMessages()
	{
		return $this->messages;
	}

	/*** HELPERS ***/
	protected function _get(array $messages, $group = true, $sort = true)
	{
		$group = (bool) $group;
		$sort = (bool) $sort;

		if (!$group AND !$sort)
		{
			return new MessageResponse($messages);
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
<?php namespace Omashu\Message\Facades;

use Illuminate\Support\Facades\Facade;

class MessageFacade extends Facade {

	const INFO = "info";
	const SUCCESS = "success";
	const ERROR = "danger";
	const WARNING = "warning";

	protected static function getFacadeAccessor() { return 'message'; }
}
<?php namespace Omashu\Message\Facades;

use Illuminate\Support\Facades\Facade;

class MessageFacade extends Facade {
	protected static function getFacadeAccessor() { return 'message'; }
}
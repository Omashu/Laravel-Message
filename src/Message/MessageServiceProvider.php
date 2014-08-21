<?php

namespace Omashu\Message;

use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider {
	public function register()
	{
		$this->app->singleton('message', function($app) {
			return new Manager($app['view'], $app['session']);
		});
		$this->app->resolving('redirect', function($redirector, $app) {
			$app['session']->flash($app['message']->getSessionName(), $app['message']->getMessages());
		});
	}
}

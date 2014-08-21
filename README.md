Alert messages for laravel 4
=======

Info, Success, Danger, Warning, Custom types

Installation
------------

Use composer:
-------------

	"repositories": [
		{
			"type": "git",
			"url": "https://github.com/Omashu/Message"
		}
	],
	"require": {
		"omashu/message": "1.0"
	},
	
Use module:
----------

	// create messages
	Message::info("Message");
	Message::success("Message");
	Message::danger("Message");
	Message::warning("Message");
	Message::create("Message", "custom");

	// create by validator object
	$validator = Validator::make(Input::all(), User::rules("register"));
	if ($validator->fails()) {
		Message::danger($validator);
		return Redirect::to("register");
	}

	// show all messages
	echo Message::getView(); // use default view

	// show by type
	echo Message::getView(null, Message::getSuccess());

	// use your view
	echo Message::getView('my/view/path');

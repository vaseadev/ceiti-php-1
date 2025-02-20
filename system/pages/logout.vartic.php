<?php
	Config::onlyLogged();

	unset($_SESSION[Config::$loginSessionName]);

	Config::alert("success", "Te-ai delogat cu succes!", "#");
<?php
Config::set('site_name', 'Cool site');

Config::set('languages', ['en', 'uk']);

Config::set('dir', 'mvc/');
Config::set('views_dir', 'views');

Config::set('routes', ['default' => '', 'admin' => 'admin_']);


Config::set('default_language', 'en');
Config::set('default_controller', 'page');
Config::set('default_action', 'index');
Config::set('default_route', 'default');

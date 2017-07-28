<?php
Config::set('site_name', 'Cool site');

Config::set('languages', ['en', 'uk']);

Config::set('dir', 'mvc' . DS);
Config::set('views_dir', 'views');

Config::set('routes', ['default' => '', 'admin' => 'admin_']);


Config::set('default_language', 'en');
Config::set('default_controller', 'page');
Config::set('default_action', 'index');
Config::set('default_route', 'default');

Config::set('db_host', 'localhost');
Config::set('db_name', 'mvc');
Config::set('db_user', 'root');
Config::set('db_pass', '');

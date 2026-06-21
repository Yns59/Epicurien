<?php
require_once('plugins/login-servers.php');
/** Set supported servers
	* @param array{server:string, driver:string}[] $servers [$description => ["server" => , "driver" => "server|pgsql|sqlite|..."]], note that the driver for MySQL is called 'server'
	*/
return new AdminerLoginServers(
	$servers = [
		"PostgreSQL le_44" => ["server" => "database", "driver" => "pgsql"],
	]
);

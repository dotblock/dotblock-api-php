<?php

include_once("dotblock.api.php");

$dotblock = new DotBlockAPI('josh@dotblock.com', 'pwn13s');

// Get server list
var_dump($dotblock->server_list());

// Get server info for 123456
var_dump($dotblock->server_info(123456));

// Reboot server 123456
var_dump($dotblock->reboot_server(123456));

// Boot server 123456
var_dump($dotblock->boot_server(123456));

// Suspend server 123456
var_dump($dotblock->suspend_server(123456));

// Resume server 123456
var_dump($dotblock->resume_server(123456));

// Shutdown server 123456
var_dump($dotblock->shutdown_server(123456));

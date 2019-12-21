<?php

$config = array(
	'db' => array(
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => 'library'
	)
);


$connection = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['db']
);

if ($connection == false) {
	echo mysqli_connect_error();
	exit();
};


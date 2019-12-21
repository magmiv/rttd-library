<?php 

require '../includes/config.php';

session_start();

$_POST['url'] = htmlspecialchars($_POST['url']);
$_POST['url'] = mysql_escape_string($_POST['url']);

$_POST['new_rating'] = htmlspecialchars($_POST['new_rating']);
$_POST['new_rating'] = mysql_escape_string($_POST['new_rating']);

$get_rating = mysqli_query($connection, "SELECT `rating` FROM `books` WHERE `url` = '".$_POST['url']."'");
$book = mysqli_fetch_assoc($get_rating);


if (!$_SESSION[$_POST['url']]) {


	$change_rating = mysqli_query($connection, "UPDATE `books` SET `rating` = '".$book['rating']. $_POST['new_rating'] . "' WHERE `url` = '".$_POST['url']."'");
	$_SESSION[$_POST['url']] = $_POST['new_rating'];


	echo $book['rating'].$_POST['new_rating'];

} else {

	for ($i = 0; $i < strlen($book['rating']); $i++) { 
		if ($book['rating'][$i] == $_SESSION[$_POST['url']]) {
			$newRating = substr_replace($book['rating'], $_POST['new_rating'], $i, 1);
		}
	}

	$change_rating = mysqli_query($connection, "UPDATE `books` SET `rating` = '".$newRating. "' WHERE `url` = '".$_POST['url']."'");
	$_SESSION[$_POST['url']] = $_POST['new_rating'];

	echo $newRating;
}


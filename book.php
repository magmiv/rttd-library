<?php
	session_start();
	if ($_SESSION[$_GET['url']]) {
		echo 
		"
			<script>
				window.onload = function(){
					var stars = document.querySelectorAll('label')
					for (var i = 0; i < stars.length; i++) {
						if (".$_SESSION[$_GET['url']]." == stars[i].title) {
							stars[i].click()
						}
					}
				}
			</script>
		";
	}

?>

<!DOCTYPE html>
<html lang="en">


		<?php 
				require 'includes/config.php';

				$_GET['url'] = htmlspecialchars($_GET['url']);

				$get_book = mysqli_query($connection, "SELECT * FROM `books` WHERE `url` = '".$_GET['url']."'");

				$book = mysqli_fetch_assoc($get_book);
				if (!isset($book)) {
					echo "404. Page not found";
					die();
				}

				$views = mysqli_query($connection, "UPDATE `books` SET `views` = `views`+1 WHERE `url` = '".$_GET['url']."'");
		?>



	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>Библиотека</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link href="/css/book.css" rel="stylesheet" type="text/css">

	</head>




	<body>

		<div class="wrapper">
			



			<div class="header">

				<a href="/index.php">
					<img src="/imgs/logo.png" alt="">
				</a>
				<!-- <input type="text"> -->
			</div>

				


				<p class="book_name"><?php echo $book['name']; ?></p>

				<div class="content">
					<div class="description">
						<img src="/imgs/<?php echo $book['img']; ?>" alt="">

						<div>
							<p>Автор: <span><?php echo $book['author']; ?></span></p>
							<p>Дата выхода: <span><?php echo $book['pubdate']; ?></span></p>
							<p>Кол-во страниц: <span><?php echo $book['pages']; ?></span></p>
							<p>Жанр: <span><?php echo $book['genre']; ?></span></p>
							<div class="rating top">
								<p>
									<?php
										$rating = $book['rating'];
										$strlenght = strlen($rating);
										$totalRating = 0;
										for ($i=0; $i < $strlenght; $i++) { 
											$totalRating += $rating[$i];
										}

										echo number_format( round($totalRating/$strlenght, 1), 1);
									?>
								</p>
						</div>
						</div>


							



					</div>
					



					<div>


						<div class="text">
							<p><?php echo $book['text']; ?></p>
						</div>


						<div class="mark_wrap">
								<div class="rating bottom">
									<p>
										<?php
											$rating = $book['rating'];
											$strlenght = strlen($rating);
											$totalRating = 0;
											for ($i=0; $i < $strlenght; $i++) { 
												$totalRating += $rating[$i];
											}

											echo number_format( round($totalRating/$strlenght, 1), 1);
										?>
									</p>
								</div>

								<div class="stars">
										<input id="star-4" type="radio" name="reviewStars"/>
										<label title="5" for="star-4"></label>

										<input id="star-3" type="radio" name="reviewStars"/>
										<label title="4" for="star-3"></label>

										<input id="star-2" type="radio" name="reviewStars"/>
										<label title="3" for="star-2"></label>

										<input id="star-1" type="radio" name="reviewStars"/>
										<label title="2" for="star-1"></label>

										<input id="star-0" type="radio" name="reviewStars"/>
										<label title="1" for="star-0"></label>
								</div>
							</div>



						</div>
				</div>


		</div>






		<script>
			for (var i = 0; i < document.querySelectorAll("label").length; i++) {
				document.querySelectorAll("label")[i].onclick = function () {
					ajaxPost("url="+'<?php echo $_GET['url'] ?>'+"&new_rating="+this.title)
				}
			}






			function ajaxPost(rating) {
				var request = new XMLHttpRequest();


					request.onreadystatechange = function() {
						if (request.readyState == 4 && request.status == 200) {

							totalRating = 0
							for (var i = 0; i < request.responseText.length; i++) { 
								totalRating += +request.responseText[i];
							}


							for(var i = 0; i < document.querySelectorAll(".rating").length; i++) {
								document.querySelectorAll(".rating")[i].children[0].textContent = (totalRating/request.responseText.length).toFixed(1)
							}
							
						}
					}

										
				request.open('POST', '/controllers/book.php');
				request.setRequestHeader('content-Type', 'application/x-www-form-urlencoded')
				request.send(rating)
			}



		</script>





	</body>

</html>
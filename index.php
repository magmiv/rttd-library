<?php 
	require 'includes/config.php';

?>


<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>Библиотека</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>



		
		<!-- Слайдер реализован с помощью slick + JQ, так как лень создавать его самому-->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="js/slick/slick/slick.min.js"></script>

	 <script type="text/javascript">
    $(document).ready(function(){

      $('.slider').slick({
        arrows: true,
        lazyLoad: 'ondemand',
        slidesToShow: 5,
        slidesToScroll: 5,

        prevArrow: '<div class="arrow_wrap back"><div class="arrow"></div></div>',
        nextArrow: '<div class="arrow_wrap next"><div class="arrow"></div></div>',

        responsive: [
        
        	{
			    breakpoint: 750,
			      settings: {
			        arrows: false,
			        slidesToShow: 2.4,
			        slidesToScroll: 1
			      }
			    }
        
		  	]

      });
    });
  </script>





	</head>




	<body>
	
		<div class="wrapper">
			



			<div class="header">
				<img src="imgs/logo.png" alt="">
				<!-- <input type="text"> -->
			</div>




			<p class="group_name">Рекомендации</p>
			<div class="book_group">

				<div class="slider">

						<?php 
							$get_books = mysqli_query($connection, "SELECT * FROM `books` WHERE `is_recomend` = '1'");

							while ( $book = mysqli_fetch_assoc($get_books) ) 
							{
						?>

									<div class="book">
										<a href="<?php echo $book['url'] ?>/"><img data-src="/imgs/<?php echo $book['img'] ?>" alt=""></a>
										<p><a href="<?php echo $book['url'] ?>/"><?php echo $book['name'] ?></a></p>
									</div>

						<?php
							}
						?>



				</div>

			</div>




			<p class="group_name">Бизнес книги</p>
			<div class="book_group">

				<div class="slider">

						<?php 
							$get_books = mysqli_query($connection, "SELECT * FROM `books` WHERE `categories` = 'Бизнес книги'");

							while ( $book = mysqli_fetch_assoc($get_books) ) 
							{
						?>

									<div class="book">
										<a href="<?php echo $book['url'] ?>/"><img data-src="/imgs/<?php echo $book['img'] ?>" alt=""></a>
										<p><a href="<?php echo $book['url'] ?>/"><?php echo $book['name'] ?></a></p>
									</div>

						<?php
							}
						?>
						
				</div>

			</div>






			<p class="group_name">Мотивирующие книги</p>
			<div class="book_group">

				<div class="slider">

					<?php 
							$get_books = mysqli_query($connection, "SELECT * FROM `books` WHERE `categories` = 'Мотивирующие книги'");

							while ( $book = mysqli_fetch_assoc($get_books) ) 
							{
						?>

									<div class="book">
										<a href="<?php echo $book['url'] ?>/"><img data-src="/imgs/<?php echo $book['img'] ?>" alt=""></a>
										<p><a href="<?php echo $book['url'] ?>/"><?php echo $book['name'] ?></a></p>
									</div>

						<?php
							}
						?>
						 
				</div>

			</div>


			<p class="group_name">Книги по саморазвитию</p>
			<div class="book_group">

				<div class="slider">

					<?php 
							$get_books = mysqli_query($connection, "SELECT * FROM `books` WHERE `categories` = 'Книги по саморазвитию'");

							while ( $book = mysqli_fetch_assoc($get_books) ) 
							{
						?>

									<div class="book">
										<a href="<?php echo $book['url'] ?>/"><img data-src="/imgs/<?php echo $book['img'] ?>" alt=""></a>
										<p><a href="<?php echo $book['url'] ?>/"><?php echo $book['name'] ?></a></p>
									</div>

						<?php
							}
						?>
						 
				</div>

			</div>


			<p class="group_name">Лучшее</p>
			<div class="book_group">

				<div class="slider">

					<?php 
							$get_books = mysqli_query($connection, "SELECT * FROM `books` ORDER BY `rating` LIMIT 10");

							while ( $book = mysqli_fetch_assoc($get_books) ) 
							{
						?>

									<div class="book">
										<a href="<?php echo $book['url'] ?>/"><img data-src="/imgs/<?php echo $book['img'] ?>" alt=""></a>
										<p><a href="<?php echo $book['url'] ?>/"><?php echo $book['name'] ?></a></p>
									</div>

						<?php
							}
						?>
						 
				</div>

			</div>


		</div>



		<script src="js/lazyload.js"></script>
	


	</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Document</title>
	<link rel="icon" type="image/svg+xml" href="http://localhost/project_two/images/gamepad-solid.svg">

	<!-- Include CSS files -->
	<link href="http://localhost/project_two/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="http://localhost/project_two/css/fullPage.css">
	<style>
		.slide-toggle {
			cursor: pointer;
		}

		.chevron {
			background-color: transparent;
			fill: none;
			stroke: #f8e6de;
			stroke-width: 3;
			transition: .2s all linear;
		}

		.slide-toggle {
			transform-origin: center;
			transition: transform 0.5s ease;
		}

		.slider-prev,
		.slider-next {
			background-color: transparent;
			border: none;
		}

		.slide-toggle {
			transform: rotate(-90deg);
		}

		button :hover>.chevron,
		a :hover svg {
			stroke: #ED500A;
		}

		svg:hover>path {
			fill: #ED500A;
			transition: .5s;
		}

		<?php
		// Start session and include games data
		session_start();
		// $_SESSION['lastPage'] = 'http://localhost/project_two/index.php';
		require_once 'db/checkAuth.php';
		require_once 'db/connection.php';
		$games = getGameById($_GET['id']);
		$user_id = $_SESSION['user_id'] ?? '';
		$game_id = $_GET['id'];
		$lastPage = $_SESSION['lastPage'] ?? 'http://localhost/project_two/index.php';
		$reviews = getReviews($game_id); //here is the game id
		// Iterate through games data
		if (isset($_GET['id']) && !empty($_GET['id'])) {
		?>
		body {
			height: 100vh;
			/* background-color: black; */
			background-image: url('<?=$games['poster']?>');
			background-repeat: no-repeat;
			background-size: cover;
			margin: 0;
			padding: 0;
		}
	</style>
</head>

<body>
	<?php require_once 'components/header.php';?>
	<main>
		<div class="container">
			<div class="little-container">
				<a href="<?=$lastPage?>">
					<svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" fill="#f8e6de"/></svg>
				</a>
				<div class="game-card">
					<img src="<?=$games['photo']?>" alt="">
					<div class="min-info">
						<h2><?= $games['game_name']?></h2>
						<p><?= $games['genre']?></p>
						<?php if($games['new_price'] != $games['old_price']){ ?>
						<p class="price" style="text-decoration: line-through; color: gray;"><?= $games['old_price']?></p>
						<p class="price" style="font-weight: bold; color: green; font-size: 30px"><?= $games['new_price']?></p>
						<?php } else { ?>
						<p class="price"><?= $games['new_price']?></p>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="about">
				<h2><?= $games['game_name'] ?></h2>
				<div class="info"><p>Date:</p><p><?= $games['release_date'] ?></p></div>
				<div class="info"><p>Developers:</p><p><?= $games['developers'] ?></p></div>
				<div class="info"><p>Genre:</p><p><?= $games['genre'] ?></p></div>
				<div class="info"><p>Price:</p><p class="price"><?= $games['new_price'] ?></p></div>
				<p>About game:<br><?= $games['description'] ?></p>
			</div>

			<div class="genre-container">
				<h2>Screenshots</h2>
			</div>
			<div class="carousel-container">
				<button class="slider-prev">
					<!-- SVG for previous button -->
					<svg class="slide-toggle" direction="left" height="50" width="50">
						<polyline class="chevron" points="0,50 25,38 50,50" />
						Sorry, your browser does not support inline SVG.
					</svg>
				</button>
				<div class="carousel">
					<div class="carousel-line">
						<img src="<?=$games['screenshot_1']?>" alt="">
						<img src="<?=$games['screenshot_2']?>" alt="">
						<img src="<?=$games['screenshot_3']?>" alt="">
					</div>
				</div>
				<button class="slider-next">
					<!-- SVG for next button -->
					<svg class="slide-toggle" direction="next" height="50" width="50">
						<polyline class="chevron" points="0,0 25,12 50,0" />
						Sorry, your browser does not support inline SVG.
					</svg>
				</button>
			</div>
		</div>
		<?php
		}
		?>
		<!-- Reviews container -->
		<h2 style="margin:15px auto 0px; width: 65%">Buy <?=$games['game_name']?></h2>
		<div class="purchase_section container" style="width:65%; margin: auto">
			<img src="<?=$games['photo']?>" style='height:200px; width:200px; object-fit:cover;' alt="">
			<div class="about_game_mini">
				<h2><?=$games['game_name']?></h2>
				<h4><?=$games['genre']?></h4>
				<?php 
				$library = getLibraryGames($user_id) ?? [];
				$inLbr = false;
				foreach($library as $lb){
					if($lb['game_id'] == $game_id)
						$inLbr = true;
				}
				if(!$inLbr){?>
				<form action="http://localhost/project_two/purchase/cartform.php" method="post">
					<input type="hidden" name="game_id" value="<?=$game_id?>">
					<?php
					if($games['old_price']!=$games['new_price']){
					?>
					<h2>Special Offer!</h2>
					<button type="submit" class="purchase btn">
						Buy
						<p class = "price" style="text-decoration: line-through; color: gray;"><?= $games['old_price']?></p>
						<p class = "price" style="font-weight: bold; color: green; "><?= $games['new_price']?></p>
						<?php
					}
					else{
						?>
						<button type="submit" class="purchase btn">Buy
							<p><?= $games['old_price']?></p>
							<?php
					}
					?>
						</button>
				</form>
				<?php }else{?> 
					<p>You already have this game!</p>
				<?php }?>
			</div>
		</div>
		<?php
			if (isset($_SESSION['message']) && $_SESSION['status']=='error'){
				echo '<h1 style="margin:auto; color:red; width:max-content">'. $_SESSION['message'] .'</h1>';
			}
			elseif(isset($_SESSION['message']) && $_SESSION['status']=='success'){
				echo '<h1 style="margin:auto; color:green; width:max-content">'. $_SESSION['message'] .'</h1>';
			}
			?>
		<h2 style="width: 65%; margin: 15px auto 15px">Reviews</h2>
		<div class="review_container">
			<div class="reviews-block">
				<?php
				// Display reviews
				$rating_color = '';                
				$index = 0;
				$user_id = $_SESSION['user_id'] ?? '';
				if (count($reviews) == 0){
					echo '<h1 style="margin-left:20px">There is no review yet</h1>';
				} else {
					foreach ($reviews as $i => $review) :
						$review['game_id'] = $game_id;
						include	 'components/reviews.php';
					endforeach;
				}
				?>
			</div>
			<!-- Messages printing -->
			
			<!-- Review writing-->
			<?php $result =array_column($reviews, "user_id");
			if (!in_array($user_id, $result)):
			?>
			<form method="post" action="review/reviewHandler.php" class="review_form"> 
				<h1>Write a review</h1>
				<label for="rating" style="font-size:30px">Rating:</label>
				<select name="rating" style="height:30px; color: azure; border: 2px solid #ED500A;
					border-radius: 10px; background: #2B2B2B;" required>
					<?php
					for ($i = 10; $i >= 1; $i--) {
						echo '<option value="' . $i . '">' . $i . '</option>';
					}
					?>
				</select><br>
				<label for="review" style="font-size:30px">Review:</label><br>
				<textarea name="review" rows="4" cols="50" class="review_content"></textarea><br>
				<input type="text" style="visibility: hidden; height:0; width:0; margin:0; padding:0;" value="<?=$_GET['id']?>" name='game_id'> 
				<input type="submit" value="Submit Review" class="button">
			</form>
			<?php endif;?>
		</div>
		<?php
		unset($_SESSION['status']);
		unset($_SESSION['message']);
		include 'components/footer.php';
		?>
	</main>
	<script src="http://localhost/project_two/scripts/fullgame.js" defer></script>
	<script src="http://localhost/project_two/scripts/review_modal.js" defer></script>
</body>
</html>

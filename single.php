<?php
include "header.php";
?>
		<div id="content" class="site-content">
			<div id="myModal" class="modal">
			  <span class="close cursor" onclick="closeModal()">&times;</span>
			  <div class="modal-content">
				<?php for ($i=0; $i < $single; $i++) { ?>
			    <div class="mySlides">
			      <div class="numbertext"><?php echo ($i+1); ?> / 20</div>
			      <img src="<?php echo $url_img[$i]; ?>">
			    </div>
			    <?php } ?>
			    
			    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			    <a class="next" onclick="plusSlides(1)">&#10095;</a>

			    <div class="caption-container">
			      <p id="caption"></p>
			    </div>
			  </div>
			</div>
			<div id="primary" class="content-area column two-thirds single-portfolio">
				<main id="main" class="site-main">
				
				<article class="portfolio hentry">
				<div class="entry-header">
				<h1 class="entry-title"><?php echo $post_title; ?></h1>
				<?php echo $ads1; ?>
				</div>
				<div class="single_nav">
					<?php
					$posts = explode("\n", $get_post);
					$random_post = array_rand($posts,$randsingle);
					for ($i=0; $i < $randsingle; $i++) {
						$ran_title = explode("\n", file_get_contents("data/post/".$posts[$random_post[$i]]."/data.txt"));
					?>
					<a class="navlink<?php echo rand(1,8);?>" href="<?php echo $url.'/'.$posts[$random_post[$i]]; ?>.html">
						<?php echo $ran_title[0]; ?>
					</a>
					<?php } ?>
				</div>
				<div class="entry-content one">
					<img src="<?php echo $url_img[0]; ?>" alt="<?php echo $title_img[0]; ?>" onclick="openModal();currentSlide(1)"/>
					<?php echo $ads1; ?>
				</div>
				<div class="entry-content">
					<div class="grid portfoliogrid">
						<?php
						if (count($url_img) > $single) {
							for ($i=1; $i < $single; $i++) {
						?>
						<article class="hentry">
						<div class="entry-header border">
						<div class="entry-thumbnail">
							<img src="<?php echo $url_img[$i]; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image sub_img" alt="<?php echo $title_img[$i]; ?>" onclick="openModal();currentSlide(<?php echo ($i+1); ?>)"/>
						</div>
						<h3 class="entry-title"><?php echo $title_img[$i]; ?></h3>
						</div>
						</article>
						<?php
						}}
						if (count($url_img) <= $single) {
							for ($i=1; $i < count($url_img); $i++) {
						?>
						<article class="hentry">
						<div class="entry-header border">
						<div class="entry-thumbnail">
							<img src="<?php echo $url_img[$i]; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image sub_img" alt="<?php echo $title_img[$i]; ?>" onclick="openModal();currentSlide(<?php echo ($i+1); ?>)"/>
						</div>
						<h3 class="entry-title"><?php echo $title_img[$i]; ?></h3>
						</div>
						</article>
						<?php }} ?>						
					</div>
					<!-- .grid -->
				</div>
				Source : 
				<a class="link" href="https://www.pinterest.com/" target="_blank">
					Pinterest
				</a>
				</article>
				
				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->			
			<?php include "sidebar.php"; ?>
		</div>
		<!-- #content -->
	</div>
	<!-- .container -->
<?php include "footer.php"; ?>

<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
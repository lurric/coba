<?php
$check_post = array_filter(explode("\n", file_get_contents("data/post.txt")));
if ($check_post) { 
?>
<?php include "header.php"; ?>
		<div id="content" class="site-content">
			<div id="primary" class="content-area column full">
				<main id="main" class="site-main">
				<div class="grid portfoliogrid">
					<?php
					$posts = explode("\n", $get_post);
					$random_post = array_rand($posts,$home);
					for ($i=0; $i < $home; $i++) { 
						$ran_title = explode("\n", file_get_contents("data/post/".$posts[$random_post[$i]]."/data.txt"));
						$ran_img = explode("\n", file_get_contents("data/post/".$posts[$random_post[$i]]."/urlimg.txt"));
						$ran_titleimg = explode("\n", file_get_contents("data/post/".$posts[$random_post[$i]]."/titleimg.txt"));
					?>
					<article class="hentry">
					<div class="entry-header">
					<div class="entry-thumbnail">
						<a href="<?php echo $url."/".$posts[$random_post[$i]]; ?>.html">
							<img src="<?php echo $ran_img[0]; ?>" alt="<?php echo $ran_titleimg[0]; ?>"/>
						</a>
					</div>
					<h2 class="entry-title"><a href="<?php echo $url."/".$posts[$random_post[$i]]; ?>.html" rel="bookmark"><?php echo $ran_title[0]; ?></a></h2>
					</div>
					</article>
					<?php } ?>
				</div>
				<!-- .grid -->
				
				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->
		</div>
		<!-- #content -->
	</div>
	<!-- .container -->
<?php
include "footer.php";
} else { ?>
<style type="text/css">
body {
  background: url("https://omi.uk/wp-content/uploads/2020/05/UnderConstruction.png") no-repeat fixed center;
}
</style>
<?php } ?>
<?php include "header.php"; ?>
		<!-- #masthead -->
		<div id="content" class="site-content">
			<div id="primary" class="content-area column two-thirds">
				<main id="main" class="site-main" role="main">
				<article>
				<div class="entry-header">
				<h1 class="entry-title"><?php echo $title_page; ?></h1>
				</div>
				<!-- .entry-header -->
				<div class="entry-content">
					<?php echo $data; ?>
				</div>
				</main>
				<!-- #main -->
			</div>
			<?php include "sidebar.php"; ?>
		</div>
		<!-- #content -->
	</div>
	<!-- .container -->
<?php include "footer.php"; ?>
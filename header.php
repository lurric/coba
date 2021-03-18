<?php
include "data.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (isset($_GET['page'])) { 
	$page = isset($_GET['page']) ? $_GET['page'] : '';
	function GetPostsByPage($page) {
		$page = strtolower(trim($page));
		$page = str_replace(".html", "", $page);
		$page = str_replace("/p/", "", $page);
		$page = preg_replace('/[^a-z0-9-]/', '-', $page);
		$page = preg_replace('/-+/', "-", $page);
		$page = rtrim($page, '-');
		$page = rtrim($page, '/');
		$page = preg_replace('/\s+/', '-', $page);
		return $page;
	}
	$data = file_get_contents("data/page/".$page.".txt");
	$page = GetPostsByPage($page);
	$title_page = strtoupper(str_replace("-", " ", $page));
?>
<title><?php echo $title_page; ?></title>
<link rel="canonical" href="<?php echo $url.'/p/'.$page; ?>.html" />
<?php
}
if (isset($_GET['permalink'])) { 
	$permalink = isset($_GET['permalink']) ? $_GET['permalink'] : '';
	function GetPostsByPemrlink($permalink) {
		$permalink = strtolower(trim($permalink));
		$permalink = str_replace(".html", "", $permalink);
		$permalink = preg_replace('/[^a-z0-9-]/', '-', $permalink);
		$permalink = preg_replace('/-+/', "-", $permalink);
		$permalink = rtrim($permalink, '-');
		$permalink = rtrim($permalink, '/');
		$permalink = preg_replace('/\s+/', '-', $permalink);
		return $permalink;
	}
	$permalink = GetPostsByPemrlink($permalink);
	$data = explode("\n", file_get_contents("data/post/".$permalink."/data.txt"));
	$post_title = $data[0];
	$url_img = explode("\n", file_get_contents("data/post/".$permalink."/urlimg.txt"));
	$title_img = explode("\n", file_get_contents("data/post/".$permalink."/titleimg.txt"));
	$metades = array();
	for ($i=0; $i < 17; $i++) {
		$metades[] = ucfirst($title_img[$i]);
	}
	$metakw = array(strtolower($post_title));
	if (count($title_img) > 25) {
		for ($i=0; $i < 25; $i++) {
			$metakw[] = strtolower($title_img[$i]);
		}
	}
	if (count($title_img) <= 25) {
		for ($i=0; $i < count($title_img); $i++) {
			$metakw[] = strtolower($title_img[$i]);
		}
	}
?>
<meta name='robots' content='all,index,follow' />
<title><?php echo $post_title; ?></title>
<meta name="description" content="<?php echo implode('. ', $metades); ?>"/>
<meta name="keywords"  content="<?php echo implode(', ', $metakw); ?>" />
<link rel="canonical" href="<?php echo $url.'/'.$permalink; ?>.html" />
<?php
} 
if (!isset($_GET['page']) && !isset($_GET['permalink'])) {
?>
<meta name='robots' content='index,follow' />
<title><?php echo $blog_title." - ".$tagline; ?></title>
<meta name="description" content="<?php echo $meta[0]; ?>"/>
<meta name="keywords"  content="<?php echo $meta[1]; ?>" />
<link rel="canonical" href="<?php echo $url; ?>" />
<?php } ?>
<meta name="robots" content="max-snippet:50, max-image-preview:large" />
<link rel='stylesheet' href='<?php echo $url; ?>/css/woocommerce-layout.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo $url; ?>/css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)'/>
<link rel='stylesheet' href='<?php echo $url; ?>/css/woocommerce.css' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo $url; ?>/css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500,700%7CHerr+Von+Muellerhoff:400,500,700%7CQuattrocento+Sans:400,500,700' type='text/css' media='all'/>
<link rel='stylesheet' href='<?php echo $url; ?>/css/easy-responsive-shortcodes.css' type='text/css' media='all'/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='<?php echo $url; ?>/css/style.css' type='text/css' media='all'/>
<?php include "style.php"; ?>

</head>
<body <?php if (isset($page)) { echo 'class="single single-post"'; } else { echo 'class="home page page-template page-template-template-portfolio page-template-template-portfolio-php"'; } ?> >
<div id="page">
	<div class="container">
		<div id="masthead" class="site-header">
		<div class="site-branding">
			<?php if (!isset($page) && !isset($permalink)) { ?>
			<h1 class="site-title"><a href="<?php echo $url; ?>" rel="home"><?php echo $blog_title; ?></a></h1>
			<?php  } else { ?>
			<h2 class="site-title"><a href="<?php echo $url; ?>" rel="home"><?php echo $blog_title; ?></a></h2>
			<?php } ?>
			<h2 class="site-description"><?php echo $tagline; ?></h2>
			<?php echo $ads1; ?>
			<!--<form class="wpcf7" method="post" action="contact.php" id="contactform">
				<div class="form search">
					<input type="text" name="search" placeholder="Search">
					<button type="submit" id="submit" class="clearfix btn">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form>-->
		</div>
		</div>
		<!-- #masthead -->
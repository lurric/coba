<style type="text/css">
<?php 
$bgcolor = array("#f8f9fa","#28a745","#007bff","#dc3545","#343a40","#6c757d","#17a2b8","#ffc107");
$fontcolor = array("#212529","#ffffff","#ffffff","#ffffff","#ffffff","#ffffff","#ffffff","#212529");
for ($i=1; $i <= 8; $i++) { 
?>
.navlink<?php echo $i; ?> {
	background-color: <?php echo $bgcolor[$i]; ?>; 
	color: <?php echo $fontcolor[$i]; ?>!important; 
	display: inline-block; 
	margin-top: 5px; 
	padding: .25em .4em; 
	font-size: 95%; 
	font-weight: 700; 
	white-space: nowrap; 
	border-radius: .25rem; 
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
<?php } ?>
</style>
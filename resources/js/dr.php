<?php
 header( "Content-type: application/javascript'; charset=UTF-8");
	session_start();
	ini_set('display_errors', 0);
ini_set('log_errors', 0);
if ( $_SESSION['jssdr_']){
?>


$(document).ready(function() { 
<?php
	
	foreach (	$_SESSION['jssdr_'] as $k=>$v){
	
	echo str_replace("{pref}",$_SESSION['pref'],$v);
											}
	
		?>
							});

<?php   				}	?>
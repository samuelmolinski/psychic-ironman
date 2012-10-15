<?php
    if(NULL != $_GET['title']) {
    	$title = trim($_GET['title']);
    } else {
    	$title = 'Poder do Curtir';
    }
    if(NULL != $_GET['description']) {
    	$description = $_GET['description'];
    } else {
    	$description = 'Descubra o Poder do Curtir e venha fazer a diferença com a gente.';
    }
    if(NULL != $_GET['image']) {
    	$image = $_GET['image'];
    } else {
    	$image = 'http://msf.org.br/poderdocurtir/images/icons/Icone_app_111x74.png';
    }
    if(NULL != $_GET['forwardURL']) {
    	$forwardURL = $_GET['forwardURL'];
    } else {
    	$forwardURL = 'https://www.facebook.com/MedicosSemFronteiras/app_402784116453669';
    }
    if(NULL != $_GET['page']) {
    	$page = 'page='.$_GET['page'];
    } else {
    	$page = NULL;
    }
	

	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Poder do Curtir</title>

<meta property="fb:app_id" content="402784116453669">
<meta property="fb:admins" content="100000220196116"/>
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:url" content="<?php echo curPageURL(); ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:image" content="<?php echo $image; ?>" />

<script type="text/javascript">
setTimeout( function() {top.location.href = '<?php echo $forwardURL; ?>'}, 200); // wordpress page
</script> 
</head>
<body>
</body>
</html>
<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>
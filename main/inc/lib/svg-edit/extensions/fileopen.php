<?php
/*
 * fileopen.php
 * To be used with ext-server_opensave.js for SVG-edit
 *
 * Licensed under the Apache License, Version 2
 *
 * Copyright(c) 2010 Alexis Deveria
 *
 * Integrate svg-edit with Chamilo
 * @author Juan Carlos Ra�a Trabado
 * @since 25/september/2010
*/

require_once '../../../../inc/global.inc.php';//hack for chamilo
require_once api_get_path(LIBRARY_PATH).'fileUpload.lib.php';

api_protect_course_script();
api_block_anonymous_users();
//Adding Chamilo style because Display :: display_error_message() dont run well.
?>
<style type="text/css">
<!--
.error-message {
	position: relative;
	margin-top: 10px;
	margin-bottom: 10px;
	border-width: 1px;
	border-style: solid;
	-moz-border-radius: 10px;
	padding: 6px;
	border: 1px solid #FF0000;
	color: #440000;
	background-color: #FFD1D1;
	min-height: 30px;
}
-->
</style>

<?php
if(!isset($_FILES['svg_file']['tmp_name'])) {
	echo '<div class="error-message">'. get_lang('lang_no_access_here').'</div>';// from Chamilo
	die();
}
?>
<!doctype html>
<?php
	// Very minimal PHP file, all we do is Base64 encode the uploaded file and
	// return it to the editor
	
	$file = $_FILES['svg_file']['tmp_name'];
	
	$output = file_get_contents($file);
	
	$type = $_REQUEST['type'];
	
	$prefix = '';
	
	// Make Data URL prefix for import image
	if($type == 'import_img') {
		$info = getimagesize($file);
		$prefix = 'data:' . $info['mime'] . ';base64,';
	}
	
//a bit title security

$filename = addslashes(trim($file));
$filename = Security::remove_XSS($filename);
$filename = replace_dangerous_char($filename, 'strict');
$filename = disable_dangerous_file($filename);


//a bit mime security
$finfo = new finfo(FILEINFO_MIME);
$current_mime=$finfo->buffer($contents);

$mime_svg='image/svg+xml';
$mime_xml='application/xml';//hack for svg-edit because original code return application/xml; charset=us-ascii.

if(strpos($current_mime, $mime_svg)===false && strpos($current_mime, $mime_xml)===false && $extension=='svg'){
	die();//File extension does not match its content
}
?>

<script>
window.top.window.svgEditor.processFile("<?php echo $prefix . base64_encode($output); ?>", "<?php echo $type ?>");
</script>
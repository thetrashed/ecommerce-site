<?php
	$HTML_DIR = 'html/';
	$HEADER_FILE = $HTML_DIR.'header.html';
	$STYLE_DIR = 'styles/';
	$SCRIPT_DIR = 'js/';

	function servePage($page_name, $stylesheet, $title, $script, $login_status) {
		global $HTML_DIR, $HEADER_FILE, $STYLE_DIR, $SCRIPT_DIR;
		# Some Directory constants and basic paths

		$NAVBAR = $HTML_DIR.'navbar.html';

		# The styles for the page
		if (!empty($stylesheet)) {
			$page_style = '<link rel=stylesheet href="'.$STYLE_DIR.$stylesheet.'.css"/>';
		} else {
			$page_style = '<link rel=stylesheet href="'.$STYLE_DIR.$page_name.'.css"/>';
		}
			
		$nav_style = '<link rel=stylesheet href="'.$STYLE_DIR.'navbar.css"/>';
		$body_style = '<link rel=stylesheet href="'.$STYLE_DIR.'body.css"/>';

		$style = $page_style.$nav_style.$body_style;
		if (!empty($script)) {
			$script_head = '<script src="'.$SCRIPT_DIR.$script.'.js"></script>';
		} else {
			$script_head = '';
		}

		$header = fileRead($HEADER_FILE).$script_head.$style.makeTitle($title).'</head><body>';

		$body_data = genNavbar($NAVBAR, $login_status).fileRead($HTML_DIR.$page_name.'.html');
		$body_close = '</body></html>';

		echo $header.$body_data.$body_close;
	}

	function fileRead($fname) {
		$fptr = fopen($fname, 'r') or die('Could not open file '.$fname);
		$fcontent = fread($fptr, filesize($fname));
		fclose($fptr);

		return $fcontent;
	}

	function makeTitle($title) {
		return '<title>'.$title.'</title>';
	}

	function echoBody($fname) {
		global $HTML_DIR;

		$file_content = fileRead($HTML_DIR.$fname.'.html');
		echo $file_content;
	}

	function genNavbar($fname, $login_status) {
		global $HTML_DIR;
		$file_contents = fileRead($fname);
		if ($login_status) {
			$search_str = '/'.preg_quote('<li><a href="login.php">Login</a></li>', '/').'/';
			$replacement = fileRead($HTML_DIR.'aoverview_dropdown.html');

			$file_contents = preg_replace($search_str, $replacement, $file_contents);

			return $file_contents;
		} 

		return $file_contents;
	}

	function sanitiseInput($string) {
		$string = trim($string);
		$string = stripslashes($string);
		$string = htmlspecialchars($string);
		return $string;
	}
?>

<?php
	$HTML_DIR = 'html/';
	$HEADER_FILE = $HTML_DIR.'header.html';
	$STYLE_DIR = 'styles/';
	$SCRIPT_DIR = 'js/';

	function servePage($page_name, $stylesheet, $title, $script, $login_status, $QUERY_STRING) {
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
		$alerts_style = '<link rel=stylesheet href="node_modules/alertifyjs/build/css/alertify.min.css">'.'<link rel=stylesheet href="node_modules/alertifyjs/build/css/themes/default.min.css">';
		$footer_style = '<link rel=stylesheet href="'.$STYLE_DIR.'footer.css"/>';
		$body_style = '<link rel=stylesheet href="'.$STYLE_DIR.'body.css"/>';

		$style = $page_style.$nav_style.$footer_style.$body_style.$alerts_style;
		$script_head = '<script src="node_modules/alertifyjs/build/alertify.min.js"></script>';
		if (!empty($script)) {
			$script_head = $script_head.'<script src="'.$SCRIPT_DIR.$script.'.js"></script>';
		}
		$header = fileRead($HEADER_FILE).$script_head.$style.makeTitle($title).'</head>';

		if ($page_name == 'products' or $page_name == 'sale' or $page_name == 'index') {
			$body_open = '<body onload="requestProducts(\''.$page_name.'\', \''.$QUERY_STRING.'\')">';
		} elseif ($page_name == 'about_us') {
			$body_open = '<body style="background-color: var(--nord2)">';
		} elseif ($page_name == 'cart') {
			$body_open = '<body onload="getCartItems()">';
		} else {
			$body_open = '<body>';
		}

		$body_data = genNavbar($NAVBAR, $login_status).fileRead($HTML_DIR.$page_name.'.html').fileRead($HTML_DIR.'footer.html');
		$body_close = '</body></html>';

		echo $header.$body_open.$body_data.$body_close;
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

	function loginStatus() {
		return !empty($_SESSION['member_username']);
	}
?>

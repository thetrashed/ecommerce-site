<?php
	function servePage($page_name, $title) {
		# Some Directory constants and basic paths
		$HTML_DIR = 'html/';
		$HEADER_FILE = $HTML_DIR.'header.html';
		$STYLE_DIR = 'styles/';

		$NAVBAR = $HTML_DIR.'navbar.html';


		# The styles for the page
		$page_style = '<link rel=stylesheet href="'.$STYLE_DIR.$page_name.'.css"/>';
		$nav_style = '<link rel=stylesheet href="'.$STYLE_DIR.'navbar.css"/>';
		$body_style = '<link rel=stylesheet href="'.$STYLE_DIR.'body.css"/>';

		$style = $page_style.$nav_style.$body_style;

		$header = fileRead($HEADER_FILE).$style.makeTitle($title).'</head><body>';

		$body_data = fileRead($NAVBAR).fileRead($HTML_DIR.$page_name.'.html');
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
?>

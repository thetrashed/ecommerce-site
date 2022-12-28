<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width,
initial-scale=1.0">

<title>Document</title>
<style> 
.highlight {
background-color: yellow;
}
</style>

</head>

<body>

<form action="SearchKeywords.php" method="post">

<label for="textarea">Enter text:</label><br>

<textarea name="text" id="textarea" rows="8"
cols="70"></textarea><br>

<label for="keyword">Enter keyword:</label><br>

<input type="text" name="keyword" id="keyword"><br><br>

<input type="submit" value="Submit">

</form>

<?php

	// Retrieve form data

	$text = $_POST['text'];

	$keyword = $_POST['keyword'];

	// Search for all occurrences of the keyword

	preg_match_all("/$keyword/i", $text, $matches);

	// Count the number of occurrences

	$count = substr_count($text, $keyword);

	// Replace all occurrences of the keyword with a highlighted version

	$text = preg_replace("/$keyword/i", "<span
	class='highlight'>$keyword</span>", $text);

	// Output the modified text and the count

	echo $text;

	echo "<br>";

	echo "Keyword '$keyword' found $count times.";

?>

</body>

</html>

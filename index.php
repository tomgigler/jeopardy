<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Jeopardy Clues for <?php echo htmlspecialchars($_GET['month']) . "/2024"; ?></title>
    <style>
        .hidden-text {
            display: none;
        }
    </style>
</head>

<body>
<?php
if(isset($_GET['year'])) {
	$year = $_GET['year'];
} else {
	$year = date('Y');
}
if(isset($_GET['month'])) {
	$month = $_GET['month'];
} else {
	$month = date('n');
}
$longMonth = $month;
if ($month < 10) { $longMonth = "0" . $month; }
for ($day = 1 ; $day < 32 ; $day++) {
	$url = "http://thejeopardyfan.com/" . $year . "/" . $longMonth . "/final-jeopardy-" . $month . "-" . $day . "-" . $year . ".html";
	$fileContent = file_get_contents($url);
	$lines = explode(PHP_EOL, $fileContent);
	for ($i = 0; $i < count($lines); $i++) {
		$answer = "";
		if(preg_match('/Final Jeopardy \(in the category \<strong\>/', $lines[$i])) { 
			$category = $lines[$i]; 
			$clue =  $lines[$i+1]; 
		}
		if(preg_match('/Correct response:/', $lines[$i])) { 
			$answer = $lines[$i];
			break;
		}
	}
	if ($answer == "") { continue; }
	echo $category;
	echo $clue;
	$pattern = "/<h2>Correct response: <span style=\"color: red;\">(.*)<\/span><\/h2>/";
    	echo "<button onclick=\"toggleText('hiddenText" . $day . "')\">Answer</button>";
	echo "<h2><p class=\"hidden-text\" id=\"hiddenText" . $day . "\">Correct response: " . preg_replace($pattern, "$1", $answer) . "</p></h2>";
}
?>

    <script>
        function toggleText(elementId) {
            var hiddenText = document.getElementById(elementId);
            if (hiddenText.style.display === "none" || hiddenText.style.display === "") {
                hiddenText.style.display = "block";
            } else {
                hiddenText.style.display = "none";
            }
        }
    </script>
</body>
</html>


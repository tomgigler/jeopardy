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
function isValidDate($date, $format = 'Y-m-d') {
	// Create a DateTime object from the given date string
	$dateTime = DateTime::createFromFormat($format, $date);

	// Check if the date was successfully created and if it matches the expected format
	return $dateTime && $dateTime->format($format) === $date;
}

if (isset($_GET['date'])) {
	$dateString = $_GET['date'];
} else {
	$today = new DateTime();
	$dateString = $today->format('Y-m-d');
}
$today = DateTime::createFromFormat('Y-m-d', $dateString);

$url = "http://thejeopardyfan.com/" . $today->format('Y') . "/" . $today->format('m') . "/final-jeopardy-" . $today->format('n') . "-" . $today->format('j') . "-" . $today->format('Y') . ".html";
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
echo preg_replace("/today.*Final Jeopardy/", "the Final Jeopardy", $category);
echo $clue;
$pattern = "/.*Correct response: <span style=\"color: ?red;?\">(.*)<\/span>.*/";

if($answer != '') {
   	echo "<button onclick=\"toggleText('hiddenText" . $day . "')\">Answer</button>";
echo "<h2><p class=\"hidden-text\" id=\"hiddenText" . $day . "\">Correct response: " . preg_replace($pattern, "$1", $answer) . "</p></h2>";
} else {
	echo $today->format('l, F j, Y');
	echo "<br>";
}

$today = DateTime::createFromFormat('Y-m-d', $dateString);

// Find tomorrow
$tomorrow = clone $today;
$tomorrow->modify('+1 day');
while($tomorrow->format('l') == 'Saturday' || $tomorrow->format('l') == 'Sunday') {
	$tomorrow->modify('+1 day');
}

// Find yesterday
$yesterday = clone $today;
$yesterday->modify('-1 day');
while($yesterday->format('l') == 'Saturday' || $yesterday->format('l') == 'Sunday') {
	$yesterday->modify('-1 day');
}

echo "<a href=\"index.php?date=".$yesterday->format('Y-m-d')."\">";
echo "\t<button>Previous</button>";
echo "</a>";
echo "<br>";
echo "<a href=\"index.php?date=".$tomorrow->format('Y-m-d')."\">";
echo "\t<button>Next</button>";
echo "</a>";
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

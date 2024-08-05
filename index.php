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
if(isset($_GET['day'])) {
	$day = $_GET['day'];
} else {
	$day = date('j');
}
$longMonth = $month;
if ($month < 10) { $longMonth = "0" . $month; }
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
echo preg_replace("/today.*Final Jeopardy/", "the Final Jeopardy", $category);
echo $clue;
$pattern = "/.*Correct response: <span style=\"color: ?red;?\">(.*)<\/span>.*/";

if($answer != '') {
   	echo "<button onclick=\"toggleText('hiddenText" . $day . "')\">Answer</button>";
echo "<h2><p class=\"hidden-text\" id=\"hiddenText" . $day . "\">Correct response: " . preg_replace($pattern, "$1", $answer) . "</p></h2>";
} else {
	$date = new DateTime();
	$date->setDate($year, $month, $day);
	echo $date->format('l, F j, Y');
	echo "<br>";
}

$last_year = $year;
$last_month = $month;
$last_day = $day - 1;
if($last_day < 1) {
	$last_month--;
	if(in_array($last_month, array('2', '4', '6', '9', '11'))) {
		$last_day = 30;
	} else {
		$last_day = 31;
	}
	if($last_month < 1) {
		$last_month = 12;
		$last_year--;
	}
}

$next_year = $year;
$next_month = $month;
$next_day = $day + 1;
if($next_day > 31 || $next_day > 30 && in_array($month, array('2', '4', '6', '9', '11'))) {
	$next_day = 1;
	$next_month++;
	if($next_month > 12) {
		$next_month = 1;
		$next_year++;
	}
}

echo "<a href=\"index.php?year=" . $last_year . "&month=" . $last_month . "&day=" . $last_day . "\">";
echo "\t<button>Previous</button>";
echo "</a>";
echo "<br>";
echo "<a href=\"index.php?year=" . $next_year . "&month=" . $next_month . "&day=" . $next_day . "\">";
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


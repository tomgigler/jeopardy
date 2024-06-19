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
$url = "http://thejeopardyfan.com/2023/05/final-jeopardy-5-11-2023.html";
$fileContent = file_get_contents($url);
$lines = explode(PHP_EOL, $fileContent);
for ($i = 0; $i < count($lines); $i++) {
	if(preg_match('/Final Jeopardy \(in the category \<strong\>/', $lines[$i])) { 
		$category = $lines[$i]; 
		$clue =  $lines[$i+1]; 
	}
	if(preg_match('/Correct response:/', $lines[$i])) { 
		$answer = $lines[$i];
		break;
	}
}
	echo $category;
	echo $clue;
	$pattern = "/<h2>Correct response: <span style=\"color: red;\">(.*)<\/span><\/h2>/";
    	echo "<button onclick=\"toggleText('hiddenText1')\">Answer</button>";
	echo "<h2><p class=\"hidden-text\" id=\"hiddenText1\">Correct response: " . preg_replace($pattern, "$1", $answer) . "</p></h2>";

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


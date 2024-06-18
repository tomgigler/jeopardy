<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Jeopardy Clues for <?php print("$_GET['month']"); ?></title>
    <style>
        .hidden-text {
            display: none;
        }
    </style>
</head>

<body>
    <p>Here&#8217;s today&#8217;s Final Jeopardy (in the category <strong>Rhyme Time: Opera Version</strong>) for Wednesday, May 8, 2024 <em>(Season 40, Game 173)</em>:</p>
    <h2><span style="color: red;">Telling the story of a duke, a jester &#038; the jester&#8217;s daughter, it was written by poet Francesco Maria Piave</span></h2>
    <button onclick="toggleText('hiddenText1')">Answer</button>
    <h2><p class="hidden-text" id="hiddenText1">Correct response: What is the Rigoletto libretto?</p></h2>

    <p>Here&#8217;s today&#8217;s Final Jeopardy (in the category <strong>1980s Fads</strong>) for Thursday, May 9, 2024 <em>(Season 40, Game 174)</em>:</p>
    <h2><span style="color: red;">A Nov. 29 1983 N.Y. Times article about these used &#8220;near-riot&#8221;, &#8220;adoptable&#8221;, &#8220;waiting for 8 hours&#8221; &#038; &#8220;my life (is) in danger&#8221;</span></h2>
    <button onclick="toggleText('hiddenText2')">Answer</button>
    <h2><p class="hidden-text" id="hiddenText2">Correct response: What are Cabbage Patch Kids?</p></h2>

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


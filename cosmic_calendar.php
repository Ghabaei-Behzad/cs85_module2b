<!--Behzad Ghabaei
CS 85 PHP
Module 2B
Insructor Seno
6/25/2026-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Calendar</title>
    <!-- All styling for the final output page is included below -->
    <style>
        body { font-family: sans-serif; background-color: #1a202c; color: #e2e8f0; }
        .container { max-width: 800px; margin: 2rem auto; padding: 2rem; background-color: #2d3748; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        h1 { text-align: center; color: #9f7aea; }
        .calendar-grid { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }
        .day-box { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 5px; background-color: #4a5568; font-size: 1.2rem; }
        .cosmic-name { background-color: #9f7aea; color: #fff; transform: scale(1.1); box-shadow: 0 0 15px #9f7aea; }
        .cosmic-month { border: 2px solid #f6e05e; }
        .cosmic-both { background-color: #ed8936; color: #fff; border: 2px solid #f6e05e; transform: scale(1.1); box-shadow: 0 0 15px #ed8936; }
    </style>
</head>
<body>

<div class="container">
    <h1>Cosmic Calendar</h1>
    <div class="calendar-grid">
        <?php
     
                // --- YOUR ENTIRE PHP SCRIPT GOES HERE ---
                

    // Fetch the raw JSON string from the URL
    $jsonString = file_get_contents('https://timeapi.io/api/time/current/zone?timeZone=America%2FLos_Angeles');

    // Decode the JSON string into a PHP object
    $data = json_decode($jsonString);

    // Extract the date data from the response and determine $dayOfYear
    $dateTimeString = $data->dateTime;
    $date = new DateTime($dateTimeString);
    $dayOfYear = (int)$date->format('z') + 1;
    $month = $data->month;
    $firstName = "Behzad";
    $nameLength = strlen($firstName);

echo "My Name is: " . $firstName;
echo "<br / >"; 
echo "Today is day number: " . $dayOfYear; 
echo "<br / >"; 
echo "The current month is: " . $month;  
echo "<br / >"; 
echo "The name length is: " . $nameLength;

for ($i = $nameLength; $i <= $dayOfYear; $i++) {
    
    // Default base style for every box
    $cssClass = "day-box";
    
    // 7. Conditional logic for Cosmic styling (using the modulo % operator)
    if ($i % $nameLength === 0 && $i % $month === 0) {
        // Divisible by BOTH name length and current month
        $cssClass .= " cosmic-both";
    } elseif ($i % $nameLength === 0) {
        // Divisible ONLY by name length
        $cssClass .= " cosmic-name";
    } elseif ($i % $month === 0) {
        // Divisible ONLY by month
        $cssClass .= " cosmic-month";
    }
    
    // 8. Output the generated calendar box HTML
    echo "<div class='$cssClass'>$i</div>";
}

/*  
DEBUGGING LOG:
A problem faced was with the git commands which added syntax errors when pushing the revised code to github.
Also my VSCode was altered when pushing the revision.  In order to push I had to pull first with
"git push -u origin main" and also I had to use "git rebase --continue". This caused concern about the syntax.
Other problems faced were, how to create a box with a color.  In the final echo statement $cssClass
chooses what color the box will become, from the if /elseif block statements.  My next problem was to find out how
cosmic-month, cosmic-name, or cosmic-both should be used. The concatanation operator (.) and the incrementing
variable $i allowed this to work.  By looking at the style code we see that a day-box is a grey color.  A cosmic-name is a purple box.
cosmic-month is a grey box with an orange border and cosmic-both is an orange box.
The for loop begins with variable i, which iterates until i is less than or equal to the day of year.
The day of year is acquired from the API.  The if / elseif condition checks with the === operator.
In PHP, === represents the Identical operator, which evaluates whether two values are strictly equal in
both value and data type.  It returns true only if both sides match perfectly without altering the variables during the check. 
== (Equal / Loose Equality): Converts the variables to a common type (called "type juggling" or coercion) before comparing them.
=== (Identical / Strict Equality): Skips type conversion entirely. If the data types are different, it immediately returns false.
As i increments, if it is divisible by the namelength and divisible by the current month both, the cosmic box will be orange.
If i is divisible by namelength only, the box will be purple. 
If i is divisible by the month only it will be grey with an orange border.  This lab effectively 
demonstarted php's ability to use modulo in conditional statements and echo results. 
PHP generates HTML for you, but the browser never see's PHP.
1. browser requests page. 2.  server runs php code. 3.  server sends html to browser.  4. browser reads html.
*/
            ?>
        </div>

    </div>
</body>
</html>

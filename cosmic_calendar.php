<<<<<<< HEAD
<!-- Behzad Ghabaei
CS 85 - PHP
Cosmic Calendar
Instructor Seno
6/25/2026
-->
=======
<!--Behzad Ghabaei
CS 85 PHP
Module 2B
Insructor Seno
6/25/2026-->

>>>>>>> 2e1bdbc (The calender also diplays user input for the loop to operate.)
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
<<<<<<< HEAD
<div class="container">
    <h1>Cosmic Calendar</h1>
    <div class="calendar-grid">
        <?php
        // --- YOUR PHP SCRIPT GOES HERE ---
       // 1. Set up your name
$firstName = "Behzad"; // <-- Replace this with your actual first name
// Changing the number of characters will affect the cosmic calender.
// one name character listed 1 - 176.
// 2. Define the URL
$apiUrl = 'https://timeapi.io';
=======
    <div class="container">
        <h1>Cosmic Calendar</h1>
        <div class="calendar-grid">
      <?php      
                // --- YOUR ENTIRE PHP SCRIPT GOES HERE ---
                

    // Fetch the raw JSON string from the URL
    $jsonString = file_get_contents('https://timeapi.io/api/time/current/zone?timeZone=America%2FLos_Angeles');
>>>>>>> 2e1bdbc (The calender also diplays user input for the loop to operate.)

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
<<<<<<< HEAD
/*
DEBUGGING LOG:
Problem: At first crashing occured with the provided website. 
The @ symbol tells PHP not to print ugly error messages directly
onto my webpage if blocked. timeapi.io 
(https://community.fabric.microsoft.com/t5/Power-Query/worldtimeapi-refresh-failing/td-p/3346758)
Problem: The if / else condition checks if the API returned valid data.
If it did not, it instantly drops into the fallback block to calculate
$dayOfYear and $month directly through PHP's built-in DateTime() engine.
(grid of boxes successfully displays!)
website at: http://cs85_projects.test/module2b/cosmic_calendar.php
The CSS classes are appended using .= " cosmic-style" 
(with a leading space) to preserve the structural baseline properties of .day-box.
The modulo operator (%) checks for a remainder of 0 to determine perfectly divisible calendar days.
The cosmic-both check is positioned first in the if tree to prevent single-match rules from
accidentally overriding a dual-match day.
API Connection: The script reads the raw payload from timeapi.io using file_get_contents.
json_decode converts the JSON string into a standard PHP object ($data).
PHP's format('z') returns a 0-indexed day (0-365). Adding 1 correctly shifts it to a
standard 1-indexed calendar day (1-366).
The API natively returns the numerical month value.
It generates a grid of 31 day boxes for the current month.
It calculates the unique daily cosmic alignments based on your previous
day-of-the-year math, and automatically applies your CSS classes
(.cosmic-name, .cosmic-month, and .cosmic-both) to the matching day.
API Fallback Added: Included an @file_get_contents check. If the API drops,
the calendar defaults to your server's system time so the website never displays an empty layout error.
Uses PHP's native format('t') function. The script auto-detects if the grid needs 28, 29, 30, or 31
boxes based on the current calendar month.
Compares each step of the loop against your alignment conditions, grouping identical
conditions together to handle the .cosmic-both class transition
*/ 
?>
=======
/*  
DEBUGGING LOG:  
By looking at the style code we see that a day-box is a grey color.  A cosmic-name is a purple box.
cosmic-month is a grey box with a purple border and cosmic-both is an orage box.
The for loop begins with variable i, which iterates until i is less than or equal to the day of year.
The day of year is acquired from the API.  The if / elseif condition checks with the === operator.
In PHP, === represents the Identical operator, which evaluates whether two values are strictly equal in both value and data type.
It returns true only if both sides match perfectly without altering the variables during the check. 
== (Equal / Loose Equality): Converts the variables to a common type (called "type juggling" or coercion) before comparing them.
=== (Identical / Strict Equality): Skips type conversion entirely. If the data types are different, it immediately returns false.
As i increments, f it is divisible by the namelength and divisible by the current month both, the cosmic box will be orange.
If i is divisible by namelength only, the box will be purple. 
If i is divisible by the month only it will be grey with an orange border.  This lab effectively 
demonstarted php's ability to use modulo in conditional statements and echo results. 
PHP generates HTML for you, but the browser never see's PHP.
1. browser requests page. 2.  server runs php code. 3.  server sends html to browser.  4. browser reads html.
*/
            ?>
        </div>
>>>>>>> 2e1bdbc (The calender also diplays user input for the loop to operate.)
    </div>
</body>
</html>
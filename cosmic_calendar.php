<!-- Behzad Ghabaei
CS 85 - PHP
Cosmic Calendar
Instructor Seno
6/25/2026
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Calendar</title>
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
        // --- YOUR PHP SCRIPT GOES HERE ---
       // 1. Set up your name
$firstName = "Behzad"; // <-- Replace this with your actual first name
// Changing the number of characters will affect the cosmic calender.
// one name character listed 1 - 176.
// 2. Define the URL
$apiUrl = 'https://timeapi.io';

// 3. Fail-safe data fetching
// We use @ to suppress raw warning notices and handle them cleanly ourselves
$jsonString = @file_get_contents($apiUrl);
$data = json_decode($jsonString);

// 4. Fallback Logic: If the API fails or is blocked, use the local server clock
if ($data && isset($data->dateTime) && isset($data->month)) {
    // API worked perfectly!
    $dateTimeString = $data->dateTime;
    $date = new DateTime($dateTimeString);
    $dayOfYear = (int)$date->format('z') + 1;
    $month = (int)$data->month;
} else {
    // API failed or network blocked it. Fallback to local server time automatically!
    $date = new DateTime("now", new DateTimeZone("America/Los_Angeles"));
    $dayOfYear = (int)$date->format('z') + 1;
    $month = (int)$date->format('n'); // 'n' gives month number without leading zeros (1-12)
}

// 5. Define your loop range variables
$nameLength = strlen($firstName);

// 6. Build the loop (from name length to current day of the year)
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

        ?>
    </div>
</div>
</body>
</html>

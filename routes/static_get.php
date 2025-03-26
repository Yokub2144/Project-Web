<?php

if (isset($_GET['ActID'])) {
    $ActID = $_GET['ActID'];


    // Fetch the gender counts for the activity
    $genderCounts = countGenderInActivity($ActID);

    // Fetch activity details (replace with your actual function)
    $activityDetails = getactivityByActID($ActID);

    // Prepare the data to pass to the template
    $data = [
        'static' => $genderCounts, // Pass gender counts as 'static'
        'activityDetails' => $activityDetails // Pass activity details
    ];
    renderView('static_get', $data);
    exit();
} else {
    echo "Error: ActID not provided.";
}

?>
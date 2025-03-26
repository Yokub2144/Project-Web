<?php
// filepath: c:\xampp\htdocs\Project-Web\templates\static_get.php


$static = $data['static']; 

// Check if $data['activityDetails'] is set
$activityDetails = $data['activityDetails'] ?? [];

var_dump($static);
?>
<!DOCTYPE html>
<html>
<head>
<title>S2O Songkran Music Festival 2025</title>
<style>
body {
  font-family: sans-serif;
  background-color:rgb(43, 21, 21);
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  margin: 0;
}

.container {
  background-color: #222;
  color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.festival-info {
  text-align: left;
}

.festival-info h1 {
  margin-top: 0;
  font-size: 24px;
}

.festival-info p {
  margin-bottom: 10px;
}

.artist-lineup {
  text-align: left;
}

.artist-lineup h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.artist-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.artist-list li {
  margin-bottom: 5px;
}

.demographics {
  text-align: left;
}

.demographics h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.demographics-table {
  width: 100%;
  border-collapse: collapse;
}

.demographics-table th, .demographics-table td {
  border: 1px solid #444;
  padding: 8px;
  text-align: left;
}

.back-button {
  display: block;
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #555;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  text-align: center;
}
</style>
</head>
<body>



<div class="container">
  <div class="festival-info">
    <h1>Pepsi presents S2O Songkran Music Festival 2025</h1>
    <p><strong>Date:</strong> 12 Apr 2025 16:00 - 14 Apr 2025 23:59</p>
  </div>
  <div class="demographics">
    <h2>Demographics</h2>
    <table class="demographics-table">
      <thead>
        <tr>
          <th></th>
          <th>Count</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Male</td>
          <td><?php echo htmlspecialchars($static['MaleCount'] ?? '0'); ?></td>
        </tr>
        <tr>
          <td>Female</td>
          <td><?php echo htmlspecialchars($static['FemaleCount'] ?? '0'); ?></td>
        </tr>
        <tr>
          <td>Under 18 year old</td>
          <td>8</td>
        </tr>
        <tr>
          <td>Over 18 year old</td>
          <td>20</td>
        </tr>
        <tr>
          <td>Total</td>
          <td>28</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <p>Created by</p>
    <a href="#" class="back-button">Back</a>
  </div>
</div>

</body>
</html>
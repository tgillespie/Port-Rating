<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<title>Gallery</title>

</head>

<body style="margin:20px;">
<?php 
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);


$query = "SELECT product_id, AVG(vote) AS AvgScore FROM rating WHERE product_id BETWEEN 1 AND 100 GROUP BY product_id ORDER BY AvgScore DESC";

$results= mysqli_query($conn, $query);

$firstRow = 1;
$secondRow = 0;
?>
<style>
td {
	padding: 5px;
}
tr {
	background-color: #ccc;
}
</style>
<table>
  <?php
while($row = mysqli_fetch_assoc($results)){
    foreach($row as $cvalue){
		if ($firstRow++ % 2 == 1 ) echo '<tr>';
        echo "<td>".$cvalue."</td>";
		if ($secondRow++ % 2 == 1 ) echo '</tr>';
    }
    print "\r\n";
}

?>
</table>
</body></html>

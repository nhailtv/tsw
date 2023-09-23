<?php
if (isset($_GET['CinemaID']) && isset($_GET['MovieID'])) {
    $cinemaID = $_GET['CinemaID'];
    $movieID = $_GET['MovieID'];

    // Include database connection
    include 'DBConnect.php';

    // Query to retrieve cinema name
    $cinemaQuery = "SELECT CinemaName FROM cinema WHERE CinemaID = $cinemaID";
    $cinemaResult = $conn->query($cinemaQuery);
    if ($cinemaResult->num_rows > 0) {
        $cinemaRow = $cinemaResult->fetch_assoc();
        $cinemaName = $cinemaRow['CinemaName'];
    } else {
        $cinemaName = "Cinema Not Found";
    }

    // Query to retrieve showtimes for the selected movie at the chosen cinema
    $showtimeQuery = "SELECT s.* FROM showtime s
                     WHERE s.MovieID = $movieID
                     AND s.RoomID IN (SELECT RoomID FROM room WHERE CinemaID = $cinemaID)";

    $result = $conn->query($showtimeQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtimes at <?php echo $cinemaName; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Showtimes at <?php echo $cinemaName; ?></h1>
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item">Showtime: <?php echo $row['ShowtimeDateTime']; ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
<?php
    $conn->close();
} else {
    echo "CinemaID or MovieID not provided in the URL.";
}
?>

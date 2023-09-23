<?php
// Check if MovieID and MovieName are provided in the URL
if (isset($_GET['MovieID']) && isset($_GET['MovieName'])) {
    $movieID = $_GET['MovieID'];
    $movieName = urldecode($_GET['MovieName']); // Decode URL-encoded movie name

    // Include database connection
    include 'DBConnect.php';

    // Query to retrieve cinemas showing the selected movie
    $sql = "SELECT c.* FROM cinema c
            INNER JOIN showtime s ON c.CinemaID = s.RoomID
            WHERE s.MovieID = $movieID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) :
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <!-- Add your HTML head content here -->
        </head>

        <body>
            <div class="container">
                <h1>Cinemas Showing <?php echo $movieName; ?></h1>
                <ul>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <li>
                            <?php echo $row['CinemaName']; ?> - Address: <?php echo $row['Address']; ?>
                            <a href="Booking.php?CinemaID=<?php echo $row['CinemaID']; ?>&MovieID=<?php echo $movieID; ?>">View Showtimes</a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </body>

        </html>
<?php
    else :
        // Redirect to 404.php
        header("HTTP/1.0 404 Not Found");
        include '404.php';
    endif;

    $conn->close();
} else {
    // Redirect to 404.php
    header("HTTP/1.0 404 Not Found");
    include '404.php';
}
?>

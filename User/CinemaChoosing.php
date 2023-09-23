<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'Head.php'; ?>
</head>

<body>
    <script>
        function filterByDate(date) {
            // Hide all cinema cards
            const cinemaCards = document.querySelectorAll('.cinema-card');
            cinemaCards.forEach(card => {
                card.style.display = 'none';
            });

            // Show cinema cards for the selected date
            const selectedDate = new Date(date);
            cinemaCards.forEach(card => {
                const cinemaDate = new Date(card.getAttribute('data-cinema'));
                if (cinemaDate.getDate() === selectedDate.getDate()) {
                    card.style.display = 'block';
                }
            });
        }
    </script>
    <?php

    $today = date('Y-m-d');

    // Calculate dates for tomorrow and the day after tomorrow
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
    $dayAfterTomorrow = date('Y-m-d', strtotime('+2 days'));

    include 'DBConnect.php';
    $MovieID = "";
    $cinemas = array(); // Initialize as an empty array

    if (isset($_GET['MovieID'])) {
        $MovieID = $_GET['MovieID'];
    }

    if ($MovieID != "") {
        $sql = "SELECT DISTINCT C.CinemaName, S.ShowtimeDateTime
        FROM Cinema AS C
        JOIN Room AS R ON C.CinemaID = R.CinemaID
        JOIN Showtime AS S ON R.RoomID = S.RoomID
        WHERE S.MovieID = $MovieID;";

        // Prepare and execute the SQL query
        $statement = $conn->prepare($sql);
        $statement->execute();

        // Fetch the result set
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cinemaName = $row['CinemaName'];
                $cinemas[] = $cinemaName;
                // Do something with the data...
            }
        } else {
            echo "No results found.";
        }
        $conn->close();
    } else {
        echo "<h1>No MovieID was selected</h1>";
    }
    ?>
    <div class="container mt-4">
        <h4>Select a Date:</h4>
        <button class="btn btn-primary" onclick="filterByDate('<?php echo $today; ?>')"><?php echo date('D', strtotime($today)); ?></button>
        <button class="btn btn-primary" onclick="filterByDate('<?php echo $tomorrow; ?>')"><?php echo date('D', strtotime($tomorrow)); ?></button>
        <button class="btn btn-primary" onclick="filterByDate('<?php echo $dayAfterTomorrow; ?>')"><?php echo date('D', strtotime($dayAfterTomorrow)); ?></button>
    </div>
    <?php 
      foreach ($cinemas as $cinemaName) {
    ?>
    <div class="cinema-card card" data-cinema="<?php echo date('Y-m-d'); ?>">
      <div class="card-body">
        <h6>
            <?php echo $cinemaName ?>
        </h6>
      </div>
    </div>
    <?php }?>
</body>

</html>

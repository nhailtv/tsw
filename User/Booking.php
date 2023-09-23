<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <?php include 'Head.php';?>
    
</head>

<body>
    <div class="container">
        <?php
        include 'DBConnect.php';
        if (isset($_GET['MovieID'])) {
            $MovieID = $_GET['MovieID'];}
        else{
            $MovieID = "";
        }
      

        if($MovieID != ""){

        
        $sql = "Select * from showtime where MovieID = $MovieID";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) :
            while ($row = $result->fetch_assoc()) :
        ?>
                <div class="showtime-card card mb-4" data-showtime="<?php echo $row['ShowtimeDateTime']; ?>">
                    <div class="card-body">  
                    <button type="button" class="btn btn-info"><?php echo $row['ShowtimeDateTime']; ?></button>
                    </div>
                </div>
            <?php
            endwhile;
        else :
            ?>
            <p>No showtimes found for this movie.</p>
        <?php
        endif;

        $conn->close();
        }else{
            ?>
                <h1>Không có phim được chọn.</h1>
            <?php 
        }
        ?>
    </div>

    <!-- Date buttons for filtering showtimes -->
 
</body>

</html>
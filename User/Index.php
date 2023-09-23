<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .horizontal-card {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .horizontal-card .card-img-top {
            max-width: 150px; /* Adjust the width as needed */
            margin-right: 20px; /* Add space between image and content */
        }
    </style>
</head>
<body>
    <div class="container">
        <?php 
        include 'DBConnect.php';
        
        $sql = "SELECT * FROM Movie ";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <div class="card mb-4 horizontal-card">
            <img src="img/<?php echo $row['Banner']; ?>" class="card-img-top" alt="Movie Poster">
            <div class="card-body">
                <h5 class="card-title">Name: <?php echo $row['Title']; ?></h5>
                <h6 class="price">
                    <span class="text-success rounded px-2 fs-5">Tác giả: <?php echo $row['Author']; ?></span>
                </h6>
                <a href="CinemaChoosing.php?MovieID=<?php echo $row['MovieID']; ?>" class="btn btn-success">Đặt vé ngay</a>
            </div>
        </div>
        <?php
            endwhile;
        else:
        ?>
        <p>No movies found.</p>
        <?php
        endif;
        
        $conn->close();
        ?>
    </div>
</body>
</html>
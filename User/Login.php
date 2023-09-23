<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">Sign in</h3>
                            <?php
                            session_start();
                            include 'DBConnect.php';
                            $notification = "";
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $email = $_POST['email'];
                                $password = $_POST['password'];

                                // Validate user credentials
                                $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$password'";
                                $result = $conn->query($sql);

                                if ($result->num_rows == 1) {
                                    $_SESSION['user_logged_in'] = true;
                                    header("Location: Index.php");
                                } else {
                                    $notification = "Login failed!";
                                }
                            }

                            $conn->close();
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <?php
                                if ($notification != '') {
                                    ?>
                                <div class="alert alert-danger mt-4"><?php echo $notification; ?></div>
                                <?php  } ?>
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX-2">Email</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                </div>
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </form>
                            <hr class="my-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
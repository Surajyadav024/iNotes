<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>iNotes!</title>
</head>

<body>
    <!-- php script                                -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "todo_list";

    $conn = mysqli_connect($servername, $username, $password, $database);
    $alert = false;
    //check connection
    if (!$conn) {
        die("connection failed" . mysqli_connect_error());
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/PHP/to_do.php">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PHP/to_do.php">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="/PHP/to_do.php" tabindex="-1" aria-disabled="true">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- php script                                -->
    <?php
    if (!$alert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
             <strong>Success!</strong> Your Notes has been inserted.
           <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <div class="container mt-3">
        <form action="/PHP/to_do.php" method="post">
            <h2>Add a Note to iNotes</h2>
            <div class="mb-3">
                <label for="title" class="form-label" require>Note Title</label>
                <input type="text" name="title" required class="form-control" id="title" placeholder="Events !!!">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Discription</label>
                <textarea class="form-control" required name="description" id="description" rows="3"></textarea>
            </div>
            <div class="mb-3" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-primary">Add Note</button>
            </div>

            <!-- php script                                -->
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $_POST["title"];
                $description = $_POST['description'];

                if (!empty($title) && !empty($description)) {
                    $insert = "INSERT INTO `list_item`( `title`, `description`) VALUES ('$title','$description')";
                    $result = mysqli_query($conn, $insert);
                    $alert = true;
                    if ($result) {

                        // Redirect to the same page to prevent form resubmission
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit();
                    } else {
                        $message = "Error inserting data: " . mysqli_error($conn);
                    }
                } else {
                    $message = "Please fill out both fields.";
                }
            } else {
                $message = "No data inserted.";
            }

            ?>
            <div class="contaner">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sno.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- php script                                -->
                        <?php
                        $select = "SELECT * FROM `list_item`";
                        $result = mysqli_query($conn, $select);

                        // $num = mysqli_num_rows($result);

                        $number = 1;
                        // Fetch each row from the result set as an associative array
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                    <th scope='row'>" . $number . "</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>Update/Delete</td>
                </tr>";
                            $number++;
                        }
                        ?>

                    </tbody>

                </table>

            </div>
        </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
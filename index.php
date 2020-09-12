<?php
try {
    $con = mysqli_connect('localhost', 'root', '', 'stuinfo');
    if (isset($_POST["btn"])) {
        $stdname = $_POST['stdname'];
        $stdreg = $_POST['stdreg'];

        if (!empty($stdname) && !empty($stdreg)) {
            $query = "INSERT INTO student(StdName,StdReg) VALUE('$stdname',$stdreg)";
            $createquery = mysqli_query($con, $query);
            if ($createquery) {
               echo "<script>alert('Data Saved Sucessfully')</script>";
            }
        } else {
            echo "Invalid Input";
        }
    }
} catch (Exception $e) {
    echo "<script>alert('Database not Found')</script>";
}


?>
<?php

if (isset($_GET['delete'])) {
    $stdid = $_GET['delete'];
    $q = "DELETE FROM student WHERE StdId= $stdid";
    $deletequery = mysqli_query($con, $q);
    if ($deletequery) {
        echo "<script>alert('Data removed Sucessfully')</script>";;
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <title>CURD</title>
</head>

<body>
    <div class="container shadow m-5 p-3">
        <form action="" method="post" class="d-flex justify-content-around">
            <input class="form-control" type="text" name="stdname" placeholder="Enter Student Name">
            <input class="form-control" type="number" name="stdreg" placeholder="Enter Regestration Number">
            <input type="submit" value="Send" name="btn" class="btn btn-success">

        </form>

    </div>
    <div class="container shadow m-5 p-3">
        <form action="" method="post" class="d-flex justify-content-around">
            <?php
            if (isset($_GET["update"])) {
                $stdid = $_GET["update"];
                $q = "SELECT * FROM student WHERE StdId= $stdid";
                $getdata = mysqli_query($con, $q);
                while ($r = mysqli_fetch_assoc($getdata)) {
                    $stdid = $r['StdId'];
                    $stdname = $r['StdName'];
                    $stdreg = $r['StdReg'];

            ?>
                    <input class="form-control" type="text" name="stdname" VALUE="<?php echo $stdname; ?>">
                    <input class="form-control" type="number" name="stdreg" VALUE="<?php echo $stdreg; ?>">
                    <input type="submit" value="Update" name="update_btn" class="btn btn-primary">

            <?php   }
            } ?>
            <?php
            if (isset($_POST["update_btn"])) {
                $stdname = $_POST['stdname'];
                $stdreg = $_POST['stdreg'];
                $qr = "UPDATE student SET StdName='$stdname',StdReg=$stdreg WHERE StdId=$stdid";
                $updateq = mysqli_query($con, $qr);

                if ($updateq) {
                    echo "<script>alert('Data updated Sucessfully')</script>";;
                }
            }

            ?>

        </form>

    </div>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Registration Number</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $q = "SELECT * FROM student";
            $readquery = mysqli_query($con, $q);
            if ($readquery->num_rows > 0) {
                while ($rd = mysqli_fetch_assoc($readquery)) {
                    $stdid = $rd['StdId'];
                    $stdname = $rd['StdName'];
                    $stdreg = $rd['StdReg'];

            ?>
                    <tr>
                        <td><?php echo $stdid; ?></td>
                        <td><?php echo  $stdname; ?></td>
                        <td><?php echo $stdreg; ?></td>
                        <td><a href="index.php?update=<?php echo $stdid; ?>" class="btn btn-info">Update</a></td>
                        <td><a href="index.php?delete=<?php echo $stdid; ?>" class="btn btn-danger">Delete</a></td>

                    </tr>
            <?php   }
            } ?>
        </table>

    </div>
    <div class="d-flex justify-content-around" >
        <iframe width="500" height="300" 
        src="https://www.youtube.com/embed/tgbNymZ7vqY">
        </iframe>
    </div>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>
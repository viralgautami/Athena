<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
if ($_SESSION['role'] != "Texas") {
    header("Location: ../index.php");
} else {
    include_once("../config.php");
    $_SESSION["userrole"] = "Librarian";
    $id = $_SESSION['id'];
}
?>
<script>
    var stid;
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .vid {
            width: 70%;
            border-radius: 10px;
            align-items: center;

        }
    </style>
    <?php include_once("../head.php"); ?>
    <script type="text/javascript" src="../vendor/instascan/instascan.min.js"></script>

    <style>
        .avatar-img {
            background: antiquewhite;
        }
    </style>
</head>

<body>
    <!-- NAVIGATION -->
    <?php
    $nav_role = "book_scan";
    include_once("nav.php");
    ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <!-- Form -->
                    <form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation">
                        <div class="tab-content py-6" id="wizardSteps">
                            <div class="tab-pane fade show active" id="wizardStepOne" role="tabpanel" aria-labelledby="wizardTabOne">

                                <!-- Header -->
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                                        <!-- Pretitle -->
                                        <h6 class="mb-4 text-uppercase text-muted">
                                            Scan Qr
                                        </h6>

                                        <!-- Title -->
                                        <h1 class="mb-3">
                                            Add Entry
                                        </h1>

                                    </div>
                                </div>
                                <?php

                                if (!isset($_POST['bsearch']) && !isset($_POST['ssearch'])) { ?>
                                    <div class="form-group align-content-center">
                                        <center><video class="vid" id="preview"></video></center>
                                    </div>
                                <?php } ?>
                                <?php

                                if (!isset($_POST['bsearch']) && !isset($_POST['ssearch'])) { ?>
                                    <div class="form-group">
                                        <p class="form-label">
                                            Book Id
                                        </p>
                                        <div class="input-group mb-3">
                                            <textarea type="text" id="bookid" name="bids" class="form-control form-control-sm" readonly aria-describedby="button-addon2"></textarea>
                                            <button class="btn btn-outline-secondary" type="submit" name="bsearch" value="2" id="button-addon2">Search</button>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">
                        let scanner = new Instascan.Scanner({
                            video: document.getElementById('preview')
                        });
                        scanner.addListener('scan', function(content) {
                            document.getElementById("bookid").innerHTML = content;

                        });
                        Instascan.Camera.getCameras().then(function(cameras) {
                            if (cameras.length > 0) {
                                scanner.start(cameras[0]);
                            } else {
                                console.error('No cameras found.');
                            }
                        }).catch(function(e) {
                            console.error(e);
                        });
                    </script>
                    <?php
                    if (isset($_POST['bsearch']) || isset($_POST['ssearch'])) {
                        $bookid = $_POST['bids'];
                        $bqur = "SELECT * FROM book where B_id = '$bookid'";
                        $bqurres = mysqli_query($conn, $bqur);
                        $bqurrow = mysqli_fetch_assoc($bqurres);
                    ?>
                        <form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation">

                            <div class="form-group">
                                <p class="form-label">
                                    Book Id
                                </p>
                                <input type="text" value="<?php echo $_POST['bids']; ?>" name="bids" id="bookid" class="form-control" readonly></input>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    Book name
                                </label>
                                <!-- Input -->
                                <input type="text" value="<?php echo $bqurrow['book_title']; ?>" id="bookname" class="form-control" readonly></input>
                            </div>

                            <!-- Team description -->
                            <div class="form-group">

                                <!-- Label -->
                                <label class="form-label mb-1">
                                    ISBN Number
                                </label>

                                <!-- Text -->
                                <input type="text" value="<?php echo $bqurrow['isbn']; ?>" id="isbn" class="form-control" readonly></input>
                            </div>
                            <label class="form-label mb-1">
                                Student Id
                            </label>
                            <div class="input-group mb-3">

                                <input type="text" class="form-control" name="sid" placeholder="Eg:- 'D22DCS154'" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" name="ssearch" value="3" id="button-addon2">Search</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['ssearch'])) {
                            $stid = $_POST['sid'];

                            $squr = "SELECT * FROM student_master where Username = '$stid'";
                            $squrres = mysqli_query($conn, $squr);
                            $squrrow = mysqli_fetch_assoc($squrres);
                            $pqur = "SELECT Student_id,sum(penalty_amount) as penalty_sum FROM penalty group by Student_id having Student_id = '$stid'";
                            $pqurres = mysqli_query($conn, $pqur);
                            $pqurrow = mysqli_fetch_assoc($pqurres);
                            $bava = $bqurrow['book_ava'];
                            $bookaval = $bava - 1;
                            $bqur = "SELECT * FROM borrow_book where user_id = '$stid'";
                            $bqurres = mysqli_query($conn, $bqur);
                            $bqurrow = mysqli_fetch_assoc($bqurres);
                            $brow = mysqli_num_rows($bqurres);
                            $updatebook = "UPDATE book SET book_ava = '$bookaval' where B_id = '$bookid'";
                            $updatebookres = mysqli_query($conn, $updatebook);
                            if (mysqli_num_rows($squrres) == 0) {
                                echo "<script>alert('Student Not Found');</script>";
                            } else { ?>
                                <form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation">
                                    <input type="text" name="sidm" value="<?php echo $squrrow['Username']; ?>" class="form-control" hidden></input>
                                    <input type="text" name="bidm" value="<?php echo $bookid; ?>" class="form-control " hidden></input>
                                    <input type="text" name="bookaval" value="<?php echo $bqurrow['book_copies']; ?>" class="form-control " hidden></input>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- Label -->
                                            <label class="form-label mb-1">
                                                Student Name
                                            </label>
                                            <!-- Text -->
                                            <input type="text" name="sname" value="<?php echo $squrrow['firstname']; ?>" class="form-control" readonly></input>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Previous Penalty
                                            </label>
                                            <input type="text" name="pp" id="t_penalty" value="<?php echo $pqurrow['penalty_sum']; ?>" class="form-control " readonly></input>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Total Borrowed
                                            </label>
                                            <input type="text" name="pp" id="t_penalty" value="<?php echo $brow ?>" id="t_borrow" class="form-control " readonly></input>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <hr class="my-5">
                                    <!-- Footer -->
                                    <div class="nav row align-items-center">
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a class="btn btn-lg btn-white" href="entry_scan.php" type="reset">Clear</a>
                                        </div>
                                        <div class="col text-center">

                                        </div>

                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-lg btn-primary" name="sub" id="submit">Add Entry</button>
                                        </div>
                                    </div>
                                </form>
                                <br><br>
                    <?php }
                        }
                    }
                    if (isset($_POST['sub'])) {
                        $bqur = "SELECT * FROM borrow_book";
                        $bqurres = mysqli_query($conn, $bqur);
                        $bqurrow = mysqli_fetch_assoc($bqurres);
                        $cur_date = date("Y-m-d");
                        $stid1 = $_POST['sidm'];
                        $bookid1 = $_POST['bidm'];;
                        $due_date = date('Y-m-d', strtotime($cur_date . ' + 7 days'));
                        $penalty = 0;
                        $borrow_sta = 'Borrowed';
                        $bbqur = "INSERT INTO borrow_book (user_id,book_id,date_borrowed, due_date, borrowed_status, book_penalty) VALUES
                         ('$stid1','$bookid1','$cur_date','$due_date','$borrow_sta','$penalty')";
                        try {
                            $run = mysqli_query($conn, $bbqur);
                            if ($run == true) {
                                echo "<script>alert('Borrowed Successfully')</script>";
                                echo "<script>window.open('borrow_list.php','_self')</script>";
                            } else {
                                echo "<script>alert('Borrowed Unsuccessfully')</script>";
                                echo "<script>window.open('borrow_list.php','_self')</script>";
                            }
                        } catch (Exception $e) {
                            echo "<script>alert('Borrowed Unsuccessfully')</script>";
                            echo "<script>window.open('borrow_list.php','_self')</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function deleteCookies() {
            var Cookies = document.cookie.split(';');
            for (var i = 0; i < Cookies.length; i++)
                document.cookie = Cookies[i] + "=;expires=" + new Date(0).toUTCString();
        }
    </script>
    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="../assets/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="../assets/js/theme.bundle.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <?php include_once("context.php"); ?>
</body>

</html>
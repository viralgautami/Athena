<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
if ($_SESSION['role'] != "Texas") {
    header("Location: ../index.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include_once "../head.php"; ?>
    </head>

    <body>
        <!-- NAVIGATION -->
        <?php
        $nav_role = "student";
        include_once 'nav.php'; ?>
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="header">
                    <div class="header-body">
                        <div class="row align-items-end">
                            <div class="col">
                                <h5 class="header-pretitle">
                                    <a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
                                </h5>
                                <h6 class="header-pretitle">
                                    Student
                                </h6>
                                <h1 class="header-title">
                                    Info
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <?php
                        include_once "../config.php";
                        $ttid = $_GET['stdid'];
                        $ttid = mysqli_real_escape_string($conn, $ttid);
                        $_SESSION["userrole"] = "Librarian";
                        if (isset($ttid)) {
                            $bqur = "SELECT * FROM student_master WHERE Username = '$ttid'";
                            $bqurres = mysqli_query($conn, $bqur);
                            $row = mysqli_fetch_assoc($bqurres);
                            $bqur = "SELECT * FROM borrow_book WHERE user_id = '$ttid'";
                            $bqurres = mysqli_query($conn, $bqur);
                            $bqurrow = mysqli_fetch_assoc($bqurres);
                            $brow = mysqli_num_rows($bqurres);
                        ?>
                            <!-- CONTENT -->
                            <div class="row">
                                <div class="col-12">
                                    <!-- Files -->
                                    <div class="card" data-list='{"valueNames": ["name"]}'>
                                        <div class="card-body">
                                            <h3 class="header-title">
                                                Student Info:
                                            </h3>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-text col-3 ">Student Username</span>
                                                <input type="text" value="<?php echo $row['firstname']; ?>" aria-label="First name" class="form-control" disabled>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-text col-3 ">Contact</span>
                                                <input type="text" value="<?php echo $row['contact']; ?>" aria-label="First name" class="form-control" disabled>
                                                <span class="input-group-text col-3 ">Id</span>
                                                <input type="text" value="<?php echo $row['Username']; ?>" aria-label="Last name" class="form-control disable" disabled>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-text col-3 ">Total Borrow</span>
                                                <input type="text" value="<?php echo $brow ?>" aria-label="First name" class="form-control" disabled>
                                                <span class="input-group-text col-3 ">Address</span>
                                                <input type="text" value="<?php echo $row['saddress']; ?>" aria-label="Last name" class="form-control disable" disabled>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <span class="input-group-text col-3 ">Penalty</span>
                                                <input type="text" value="<?php echo $row['Penalty']; ?>" aria-label="First name" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / .row -->
                    </div>
                </div>
            </div>
            <!-- / .main-content -->
        <?php } ?>
        <?php include_once("context.php"); ?>
        <!-- JAVASCRIPT -->
        <!-- Map JS -->
        <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
        <!-- Vendor JS -->
        <script src="../assets/js/vendor.bundle.js"></script>
        <!-- Theme JS -->
        <script src="../assets/js/theme.bundle.js"></script>
    </body>

    </html>
<?php } ?>
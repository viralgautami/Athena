<?php
error_reporting(E_ALL ^ E_WARNING);
session_start();
require_once("../config.php");
if ($_SESSION['role'] != "Law") {
    header("Location: ../index.php");
} else {
    $qid = $_GET['qid'];
    $type = $_GET['type'];
    $acqur = "SELECT * FROM query_master WHERE QueryId  = '$qid'";
    $acres = mysqli_query($conn, $acqur);
    $scres = mysqli_fetch_assoc($acres);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include_once("../head.php"); ?>
    </head>

    <body>
        <?php
        $nav_role = "All querys";
        include_once('nav.php'); ?>
        <div class="main-content">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-end">
                        <div class="col">
                            <h5 class="header-pretitle">
                                <a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
                            </h5>
                            <h6 class="header-pretitle">
                                Query
                            </h6>
                            <h1 class="header-title">
                                Profile
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <br> <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Files -->
                        <div class="card">
                            <div class="card-body">
                                <h2 class="header-title">
                                    Query Info :
                                </h2>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-text col-2 ">Query Subject</span>
                                    <input type="text" value="<?php echo $scres['QuerySubject']; ?>" aria-label="First name" class="form-control" disabled>
                                </div>
                                
                                <br>
                                <div class="input-group">
                                    <span class="input-group-text col-2 ">Query Question</span>
                                    <textarea rows="2" aria-label="First name" class="form-control" disabled><?php echo $scres['QueryTopic']; ?></textarea>
                                </div>
                                <?php if ($scres['QueryReply'] != "") { ?>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-text col-2 ">Query Reply</span>
                                        <textarea rows="2" aria-label="First name" class="form-control" disabled><?php echo $scres['QueryReply']; ?></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
            <script src="../assets/js/vendor.bundle.js"></script>
            <script src="../assets/js/theme.bundle.js"></script>
            <script>
                const btnreply = document.getElementById('btnreply');
                const replyform = document.getElementById('replyform');

                btnreply.onclick = () => {
                    btnreply.classList.add('d-none');
                    replyform.classList.remove('d-none');
                }
            </script>
    </body>

    </html>
<?php
} ?>
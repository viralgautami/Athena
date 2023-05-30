<?php
session_start();
if ($_SESSION['role'] != "Texas") {
  header("Location: ../index.php");
} else {
  include_once("../config.php");
  $_SESSION["userrole"] = "Librarian";
  $id = $_SESSION['id'];
  $iqur = "SELECT * FROM librarian_master WHERE admin_id = '$id'";
  $iqurres = mysqli_query($conn, $iqur);
  $bqur = "SELECT * FROM student_master";
  $bqurres = mysqli_query($conn, $bqur);
  $bqurrow = mysqli_fetch_assoc($bqurres);
  $brow = mysqli_num_rows($bqurres);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once("../head.php"); ?>
</head>

<body>
  <?php $nav_role = "student"; ?>
  <!-- NAVIGATION -->
  <?php include_once("nav.php"); ?>
  <!-- MAIN CONTENT -->
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <!-- HEADER -->
    <div class="header">
      <div class="container-fluid">
        <!-- Body -->
        <div class="header-body">

          <div class="row align-items-end">
            <div class="col">
              <h5 class="header-pretitle">
                <a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
              </h5>
              <h5 class="header-pretitle">
                Add
              </h5>
              <!-- Title -->
              <h1 class="header-title">
                Student
              </h1>
            </div>
          </div>
          <!-- / .row -->
        </div>
        <!-- / .header-body -->
      </div>
    </div>

    <div class="main-content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-xl-10">
            <!-- Form -->
            <form method="POST" action="excel.php" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
              <div class="row">
                <div class="col-12 col-md-12">
                  <!-- Email address -->
                  <div class="form-group">
                    <!-- Label -->
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Upload Excel</label>
                      <input class="form-control" name="excelfile" type="file" id="formFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Upload Formate</label>
                      <a href="../src/uploads/student.xlsx" download> Download here </a>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="mt-4 mb-5">
              <div class="d-flex justify">
                <!-- Button -->
                <button class="btn btn-primary" type="submit" value="sub" name="subbed">
                  Add Students
                </button>
              </div>
              <!-- / .row -->
            </form>
            <br>
          </div>
        </div>
        <!-- / .row -->
      </div>
    </div>
  </div>
  </div>
  <!-- JAVASCRIPT -->
  <?php include("context.php"); ?>
  <!-- / .main-content -->
  <!-- JAVASCRIPT -->
  <!-- Map JS -->
  <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
  <!-- Vendor JS -->
  <script src="../assets/js/vendor.bundle.js"></script>
  <!-- Theme JS -->
  <script src="../assets/js/theme.bundle.js"></script>
  <!-- Delete Popup -->

</body>

</html>
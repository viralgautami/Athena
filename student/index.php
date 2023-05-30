<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
if ($_SESSION['role'] != "Law") {
	header("Location: ../index.php");
} else {
	include_once("../config.php");
	$_SESSION["userrole"] = "Student";
	$id = $_SESSION['id'];
	$iqur = "SELECT * FROM student_master WHERE Username = '$id'";
	$iqurres = mysqli_query($conn, $iqur);
	$iqurrow = mysqli_fetch_assoc($iqurres);

	$bqur = "SELECT * FROM borrow_book WHERE user_id = '$id'";
	$bqurres = mysqli_query($conn, $bqur);
	$bqurrow = mysqli_fetch_assoc($bqurres);
	$brow = mysqli_num_rows($bqurres);

	$pqur = "SELECT Student_id,sum(penalty_amount) as penalty_sum FROM penalty group by Student_id having Student_id = '$id'";
    $pqurres = mysqli_query($conn, $pqur);
    $pqurrow = mysqli_fetch_assoc($pqurres);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once("../head.php"); ?>
	<style>
		.avatar-img {
			background: antiquewhite;
		}
	</style>
</head>

<body>
	<!-- NAVIGATION -->
	<?php
	$nav_role = "Dashboard";
	include_once("nav.php");
	?>

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
									Student
								</h5>
								<!-- Title -->
								<h1 class="header-title">
									Dashboard
								</h1>
							</div>
						</div>
						<!-- / .row -->
					</div>
					<!-- / .header-body -->
				</div>
			</div>
			<!-- / .header -->
			<br><br>
			<div class="container-fluid">
				<div class="page-header min-height-100 border-radius-xl mt-4">
				</div>
				<div class="card card-body blur shadow-blur mx-1 mt-n6 overflow-hidden">
					<div class="row gx-4">
						<div class="col-auto">
							<div class="avatar avatar-xxl position-relative">
								<img src="../src/uploads/stuprofile/<?php echo $iqurrow['user_image'] . "?t"; ?>" style="border-radius: 10px;" class="w-100 h-100 border-radius-lg shadow-sm">
							</div>
						</div>
						<div class="col-auto my-auto">
							<div class="h-100">
								<h1 class="mb-0 font-weight-bold text-sm">
									<?php echo $iqurrow['firstname'] . " " . $iqurrow['lastname']; ?>
								</h1>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-6">
							<div class="card  border-1">
								<div class="card-body">
									<div class="list-group list-group-flush my-n3">
										<div class="list-group-item">
											<div class="row align-items-center">
												<div class="col">
													<h5 class="mb-0">
														Roll No
													</h5>
												</div>
												<div class="col-auto">
													<h5 class="text-muted mb-0">
														<?php echo $iqurrow['Username']; ?>
													</h5>
												</div>
											</div>
										</div>
										<div class="list-group-item">
											<div class="row align-items-center">
												<div class="col">
													<h5 class="mb-0">
														Branch
													</h5>
												</div>
												<div class="col-auto">
													<small class="text-muted">
														<?php echo $iqurrow['Branch']; ?>
													</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card  border-1">
								<div class="card-body">
									<div class="list-group list-group-flush my-n3">
										<div class="list-group-item">
											<div class="row align-items-center">
												<div class="col">
													<h5 class="mb-0">
														Primary Contact Number
													</h5>
												</div>
												<div class="col-auto">
													<h5 class="text-muted mb-0">
														<?php echo $iqurrow['contact']; ?>
													</h5>
												</div>
											</div>
										</div>
										<div class="list-group-item">
											<div class="row align-items-center">
												<div class="col">
													<h5 class="mb-0">
														Primary E-mail Id
													</h5>
												</div>
												<div class="col-auto">
													<h5 class="text-muted mb-0">
														<?php echo $iqurrow['Email']; ?>
													</h5>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-lg-6 col-xl">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col">
										<h6 class="text-uppercase text-muted mb-2">
											Total Borrow
										</h6>
										<span class="h2 mb-0">
											<?php echo $brow; ?>
										</span>
									</div>
									<div class="col-auto">
										<span class="h2 uil-book-alt text-muted mb-0"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6 col-xl">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col">
										<h6 class="text-uppercase text-muted mb-2">
											Total penalty
										</h6>
										<span class="h2 mb-0">
											<?php echo $iqurrow['Penalty']; ?>
										</span>
									</div>
									<div class="col-auto">
										<span class="h2 uil-money-withdrawal text-muted mb-0"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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
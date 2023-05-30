<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
if ($_SESSION['role'] != "Texas") {
	header("Location: ../index.php");
} else {
	include_once("../config.php");
	$_SESSION["userrole"] = "Librarian";
	$id = $_SESSION['name'];
	$iqur = "SELECT * FROM librarian_master WHERE firstname = '$id'";
	$iqurres = mysqli_query($conn, $iqur);
	$iqurrow = mysqli_fetch_assoc($iqurres);
	$bqur = "SELECT * FROM book";
	$bqurres = mysqli_query($conn, $bqur);
	$bqurrow = mysqli_fetch_assoc($bqurres);
	$brow = mysqli_num_rows($bqurres);
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

			<!-- Image -->
			<img src="../assets/img/covers/profile-cover-1.jpg" class="header-img-top" alt="...">

			<div class="container-fluid">

				<!-- Body -->
				<div class="header-body mt-n5 mt-md-n6">
					<div class="row align-items-end">
						<div class="col-auto">

							<!-- Avatar -->
							<div class="avatar avatar-xxl header-avatar-top">
								<img src="../assets/img/avatars/lib.png" alt="..." class="avatar-img rounded-circle border border-4 border-body">
							</div>

						</div>
						<div class="col mb-3 ml-n3 ml-md-n2">
							<!-- Title -->
							<h1 class="header-title">
								<?php echo $iqurrow['firstname'] ." " . $iqurrow['lastname']; ?>
							</h1>

						</div>
					</div> <!-- / .row -->
				</div> <!-- / .header-body -->

			</div>
		</div>
	</div> <!-- / .main-content -->

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
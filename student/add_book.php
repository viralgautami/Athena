<?php
session_start();
if ($_SESSION['role'] != "Law") {
	header("Location: ../index.php");
} else {
	include_once("../config.php");

	$_SESSION["userrole"] = "Student";
}
$bqur = "SELECT * FROM book_request";
$bqurres = mysqli_query($conn, $bqur);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once("../head.php"); ?>
</head>

<body>
	<!-- NAVIGATION -->
	<?php
	$nav_role = "book_scan";
	include_once("nav.php"); ?>
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-xl-10">
					<!-- Header -->
					<div class="header mt-md-5">
						<div class="header-body">
							<div class="row align-items-center">
								<div class="col">
									<h5 class="header-pretitle">
										<a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
									</h5>
									<h6 class="header-pretitle">
										Request New
									</h6>
									<!-- Title -->
									<h1 class="header-title">
										Book
									</h1>
								</div>
							</div>
							<!-- / .row -->
						</div>
					</div>
					<!-- / .row -->
					<!-- Divider -->
					<!-- <hr class="my-5"> -->
					<form method="POST" autocomplete="off" enctype="multipart/form-data" class="row g-3 needs-validation">
						<!-- / .row -->
						<div class="row">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label for="validationCustom01" class="form-label">Book name</label>
									<input type="text" maxlength="30" class="form-control" id="validationCustom01" name="bname" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label for="validationCustom01" class="form-label">Author Name</label>
									<input type="text" maxlength="30" class="form-control" id="validationCustom01" name="aname" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<br>
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label for="validationCustom01" class="form-label">Publisher name</label>
									<input type="text" maxlength="30" class="form-control" id="validationCustom01" name="pname" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<br>
						</div>
						<!-- / Personal details-->
						<!-- Divider -->
						<hr class="mt-4 mb-5">
						<div class="d-flex justify">
							<!-- Button -->
							<button class="btn btn-primary" type="submit" value="sub" name="subbed">
								Request Book
							</button>
						</div>
					</form>
					<br>
				</div>
			</div>
			<!-- / .row -->
		</div>
		<br><br><br>
	</div>
	<?php include_once("context.php"); ?>
	<!-- Map JS -->
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
	<!-- Vendor JS -->
	<script src="../assets/js/vendor.bundle.js"></script>
	<!-- Theme JS -->
	<script src="../assets/js/theme.bundle.js"></script>
	<script>
		function cp1() {
			/* Get the text field */
			var copyText = document.getElementById("demo");

			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /* For mobile devices */

			/* Copy the text inside the text field */
			navigator.clipboard.writeText(copyText.value);

			/* Alert the copied text */
			alert("Copied the text: " + copyText.value);
		}
	</script>
	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.prototype.slice.call(forms)
				.forEach(function(form) {
					form.addEventListener('submit', function(event) {
						if (!form.checkValidity()) {
							event.preventDefault()
							event.stopPropagation()
						}

						form.classList.add('was-validated')
					}, false)
				})
		})()
	</script>
	<script>
		function cp() {
			var x = document.getElementsByName("isbn")[0].value;
			let s = x.toString();
			let x1 = s.substr(0, 6);
			document.getElementById("demo").innerHTML = x1;
		}
	</script>
</body>

</html>
<?php
if (isset($_POST['subbed'])) {

	$bname = $_POST['bname'];
	$author = $_POST['aname'];
	$pname = $_POST['pname'];
	$sid = $_SESSION['id'];

	$sql = "INSERT INTO book_request (book_name, b_author, b_publisher, s_id) VALUES ('$bname','$author','$pname','$sid')";
	try {
		$run = mysqli_query($conn, $sql);
		if ($run == true) {
			echo "<script>alert('Requested Successfully')</script>";
			echo "<script>window.open('book.php','_self')</script>";
		} else {
			echo "<script>alert('Request Not Added')</script>";
			echo "<script>window.open('book.php','_self')</script>";
		}
	} catch (Exception $e) {
		echo "<script>alert('Request Not Added')</script>";
		echo "<script>window.open('book.php','_self')</script>";
	}
}
?>
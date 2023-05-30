<?php
session_start();
if ($_SESSION['role'] != "Texas") {
	header("Location: ../index.php");
} else {
	include_once("../config.php");

	$_SESSION["userrole"] = "Librarian";
}
$bqur = "SELECT * FROM book";
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
	$nav_role = "Student";
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
										Add New
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
						<div class="row justify-content-between align-items-center">
							<div class="col">
								<div class="row align-items-center">
									<div class="col-auto">
										<!-- Personal details -->
										<!-- Avatar -->
										<div class="avatar">
											<img name="StuIMG" class="avatar-img rounded-circle" src="../assets/img/stu.png" alt="..." id="IMG-preview">
										</div>
									</div>
									<div class="col ml-n2">
										<!-- Heading -->
										<h4 class="mb-1">
											Student Photo
										</h4>
										<!-- Text -->
										<small class="text-muted">
											Only allowed PNG or JPG less than 2MB
										</small>
									</div>
								</div>
								<!-- / .row -->
							</div>
							<div class="col-auto">
								<!-- Button -->
								<input type="file" id="img" name="bimg" class="btn btn-sm" onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/png" required>
							</div>
						</div>
						<!-- Priview Profile pic  -->
						<script>
							function showPreview(event) {
								var file = document.getElementById('img');
								if (file.files.length > 0) {
									// RUN A LOOP TO CHECK EACH SELECTED FILE.
									for (var i = 0; i <= file.files.length - 1; i++) {
										var fsize = file.files.item(i).size; // THE SIZE OF THE FILE.	
									}
									if (fsize <= 2000000) {
										var src = URL.createObjectURL(event.target.files[0]);
										var preview = document.getElementById("IMG-preview");
										preview.src = src;
										preview.style.display = "block";
									} else {
										alert("Only allowed less then 2MB.. !");
										file.value = '';
									}
								}
							}
						</script>
						<!-- / .row -->
						<!-- Divider -->
						<hr class="my-5">
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
									<label for="validationCustom01" class="form-label">
										ISBN Number
									</label>
									<input type="text" pattern="[0-9]{13}" oninput="cp()" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="13" id="validationCustom01" class="form-control" name="isbn" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="validationCustom01" class="form-label">Author name #1</label>
										<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))' maxlength="20" class="form-control" id="validationCustom01" name="aname1" required>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Incorrect Format or Field is Empty!
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="validationCustom02" class="form-label">Author name #2</label>
										<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))' maxlength="20" class="form-control" id="validationCustom02" name="anmae2" required>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Incorrect Format or Field is Empty!
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="validationCustom03" class="form-label">Author name #3</label>
										<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))' maxlength="20" class="form-control" id="validationCustom03" name="aname3" required>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Incorrect Format or Field is Empty!
										</div>
									</div>
								</div>
							</div>
							<br>
							<hr class="my-5">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-label">
											Total Copies
										</label>
										<input type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="3" id="validationCustom01" class="form-control" name="tcopies" required>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Incorrect Format or Field is Empty!
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="validationCustom02" class="form-label">Publisher name</label>
										<input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))' maxlength="20" class="form-control" id="validationCustom02" name="pname" required>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Incorrect Format or Field is Empty!
										</div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">
										Category
									</label>
									<input type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="3" id="validationCustom01" class="form-control" name="cate" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">
										Book Publised
									</label>
									<input type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="4" id="validationCustom01" class="form-control" name="byear" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Incorrect Format or Field is Empty!
									</div>
								</div>
							</div>
						</div>
						<br>
						<hr class="mt-4 mb-5">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<p class="form-label">
										Book ID
									</p>
								</div>
							</div>
							<div class="col-auto col-6">
								<div class="input-group input-group-sm mb-3 ">
									<textarea id="demo" class="form-control fs-2" name="ec" id="myInput1" readonly maxlength="4"></textarea>
									<button class="btn btn-primary" onclick="cp1()"><i class="fe fe-copy"></i></button>
								</div>
							</div>
						</div>
						<!-- / Personal details-->
						<!-- Divider -->
						<hr class="mt-4 mb-5">
						<div class="d-flex justify">
							<!-- Button -->
							<button class="btn btn-primary" type="submit" value="sub" name="subbed">
								Add Book
							</button>
						</div>



						<!-- / .row -->
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
require_once '../vendor/phpqrcode/qrlib.php';
$path = '../src/uploads/qrcode/';
$qrcode = $path . time() . ".png";
$qrimage = time() . ".png";
if (isset($_POST['subbed'])) {
	$f_tmp_name = $_FILES['bimg']['tmp_name'];
	$f_size = $_FILES['bimg']['size'];
	$f_error = $_FILES['bimg']['error'];

	$bname = $_POST['bname'];
	$isbn = $_POST['isbn'];
	$author = $_POST['aname1'];
	$author2 = $_POST['aname2'];
	$author3 = $_POST['aname3'];
	$tcopy = $_POST['tcopies'];
	$pubname = $_POST['pname'];
	$cate = $_POST['cate'];
	$byear = $_POST['byear'];
	$bookid = $_POST['ec'];
	$remark = "done";

	$fs_name = $bookid . ".png";

	if ($f_error === 0) {
		if ($f_size <= 2000000) {
			move_uploaded_file($f_tmp_name, "../src/uploads/book_img/" . $fs_name); // Moving Uploaded File to Server ... to uploades folder by file name f_name ... 
		} else {
			echo "<script>alert(File size is to big .. !);</script>";
		}
	} else {
		echo "Something went wrong .. !";
	}
	$sql = "INSERT INTO book (B_ID, book_title , category_id , author , author_2 , author_3 , book_copies , publisher_name , isbn , book_image , book_barcode , date_added , remarks) 
			VALUES ('$bookid','$bname','$cate','$author','$author2','$author3','$tcopy','$pname','$isbn','$fs_name','$qrimage','$byear','$remark');";
	try {
		$run = mysqli_query($conn, $sql);
		if ($run == true) {
			echo "<script>alert('Student Added Successfully')</script>";
			echo "<script>window.open('book.php','_self')</script>";
		} else {
			echo "<script>alert('Student Not Added')</script>";
			echo "<script>window.open('add_book.php','_self')</script>";
		}
	} catch (Exception $e) {
		echo "<script>alert('Student Not Added')</script>";
		echo "<script>window.open('add_book.php','_self')</script>";
	}
	QRcode::png($bookid, $qrcode, 'H', 10, 1);
}
?>
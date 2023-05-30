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
	$bqur = "SELECT * FROM book";
	$bqurres = mysqli_query($conn, $bqur);
	$brow = mysqli_num_rows($bqurres);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once("../head.php"); ?>
</head>
<body>
	<?php $nav_role = "book"; ?>
	<!-- NAVIGATION -->
	<?php include_once("nav.php"); ?>
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12">
					<!-- Header -->
					<div class="header">
						<div class="header-body">
						<div class="row align-items-center">
								<div class="col">
									<h5 class="header-pretitle">
									<a class="btn-link btn-outline" onclick="history.back()"><i class="fe uil-angle-double-left"></i>Back</a>
								</h5>
									<h6 class="header-pretitle">
										View
									</h6>
									<!-- Title -->
									<h1 class="header-title text-truncate">
										Book List
									</h1>
								</div>
								<div class="col-auto">
									<a href="add_book.php" class="btn btn-primary ml-2">
										Add Book
									</a>
								</div>
							</div>
							<!-- / .row -->
							<div class="row align-items-center">
								<div class="col">
									<!-- Nav -->
									<ul class="nav nav-tabs nav-overflow header-tabs">
										<li class="nav-item">
											<a href="#!" class="nav-link text-nowrap active">
												All Books <span class="badge rounded-pill bg-soft-secondary"><?php echo $brow-1 ?></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Tab content -->
					<?php if ($brow) { ?>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">
								<!-- Card -->
								<div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
									<div class="card-header">
										<div class="row align-items-center">
											<div class="col">
												<!-- Form -->
												<form autocomplete="off">
													<div class="input-group input-group-flush input-group-merge input-group-reverse">
														<input class="form-control list-search" type="search" placeholder="Search">
														<span class="input-group-text">
															<i class="fe fe-search"></i>
														</span>
													</div>
												</form>
											</div>
											<div class="col-auto">
											</div>
										</div>
										<!-- / .row -->
									</div>
									<div class="table-responsive">
										<table class="table table-sm table-hover table-nowrap card-table">
											<thead>
												<tr>
													<th>
														<a class="list-sort text-muted">#</a>
													</th>
													<th>
														<a class="list-sort text-muted" data-sort="item-name">Book Title</a>
													</th>
													<th>
														<a class="list-sort text-muted" data-sort="item-email">Category</a>
													</th>
													<th>
														<a class="list-sort text-muted" data-sort="item-phone">Book Copies</a>
													</th>
													<th>
														<a class="list-sort text-muted" data-sort="item-phone">Copies Available </a>
													</th>
													<th>
														<a class="list-sort text-muted" data-sort="item-score">Date Ddded</a>
													</th>
													<th>
														<a class="list-sort text-muted justify-content-center">Action</a>
													</th>
													<th>
													</th>
												</tr>
											</thead>
											<tbody class="list font-size-base">
												<?php
												$i = 1;
												while ($row = mysqli_fetch_assoc($bqurres)) { ?>
													<tr>
														<td>
															<span class="item-email text-reset"><?php echo $i++; ?></span>
														</td>
														<td>
															<!-- Avatar -->
															<!-- <div class="avatar avatar-xs align-middle mr-2">
																<img class="avatar-img rounded-circle" src="../src/uploads/stuprofile/<?php echo $row['StudentProfilePic'] . "?t"; ?>" alt="...">
															</div> -->
															<a class="item-name text-reset"><?php echo $row['book_title'] ?></a>
														</td>
														<td>
															<!-- Email -->
															<span class="item-email text-reset"><?php echo $row['category_id']; ?></span>
														</td>
														<td>
															<!-- Phone -->
															<span class="item-phone text-reset"><?php echo $row['book_copies']; ?></span>
														</td>
														<td>
															<!-- Phone -->
															<span class="item-phone text-reset"><?php echo $row['book_ava']; ?></span>
														</td>
														<td>
															<!-- Badge -->
															<span class="item-score text-reset"><?php echo $row['date_added']; ?></span>
														</td>
														<td>
															<a href="book_view.php?bookid=<?php echo $row['book_id']; ?>" class="btn btn-sm btn-info">
																View
															</a>
															<a href="book_delete.php?bookid=<?php echo $row['book_id']; ?>" class="btn btn-sm btn-danger">
																Delete
															</a>
														</td>
														<td class="text-right">
														</td>
													</tr>
												<?php } ?>
												<!--over-->
										</table>
									</div>
									<div class="card-footer d-flex justify-content-between">
										<!-- Pagination (prev) -->
										<ul class="list-pagination-prev pagination pagination-tabs card-pagination">
											<li class="page-item">
												<a class="page-link pl-0 pr-4 border-right" href="#">
													<i class="fe fe-arrow-left mr-1"></i> Prev
												</a>
											</li>
										</ul>
										<!-- Pagination -->
										<ul class="list-pagination pagination pagination-tabs card-pagination">
											<li class="active"><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">1</a></li>
											<li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">2</a></li>
											<li><a class="page" href="javascript:function Z(){Z=&quot;&quot;}Z()">3</a></li>
										</ul>
										<!-- Pagination (next) -->
										<ul class="list-pagination-next pagination pagination-tabs card-pagination">
											<li class="page-item">
												<a class="page-link pl-4 pr-0 border-left" href="#">
													Next <i class="fe fe-arrow-right ml-1"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

					<?php } else { ?>
						<div class="col-12">
							<h1 class="card header-title m-5 p-5"> Oops, No Book registered</h1>
						</div>
					<?php
					} ?>
				</div>
			</div>
		</div>
	</div>
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
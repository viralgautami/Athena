<!-- NAVIGATION -->
<style>
	.navbar-vertical.navbar-expand-md .navbar-brand-img {
		max-height: 2rem;
	}
</style>
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
	<div class="container-fluid">
		<!-- Toggler -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- Brand -->
		<a class="navbar-brand" href="../librarian/">
			<img src="../assets/img/logo.png?t=<?php time(); ?>" class="navbar-brand-img mx-auto" alt="...">
		</a>
		<!-- User (xs) -->
		<div class="navbar-user d-md-none">
			<!-- Dropdown -->
			<div class="dropdown">
			</div>
		</div>
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidebarCollapse">
			<!-- Form -->
			<form class="mt-4 mb-3 d-md-none">
				<div class="input-group input-group-rounded input-group-merge input-group-reverse">
					<input class="form-control" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-text">
						<span class="fe fe-search"></span>
					</div>
				</div>
			</form>
			<!-- Navigation -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="../student" class="nav-link 
					<?php if ($nav_role == "Dashboard") {
						echo "active";
					} ?>">
						<i class="fe fe-home"></i> Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a href="../student/borrow_list.php" class="nav-link 
					<?php if ($nav_role == "borrow") {
						echo "active";
					} ?>">
						<i class="fe uil-archive-alt"></i> Borrow List
					</a>
				</li>
				<li class="nav-item">
					<a href="../student/book.php" class="nav-link 
					<?php if ($nav_role == "book") {
						echo "active";
					} ?>">
						<i class="fe uil-book-alt"></i> Book
					</a>
				</li>
				<li class="nav-item">
					<a href="../student/add_book.php" class="nav-link 
					<?php if ($nav_role == "book_scan") {
						echo "active";
					} ?>">
						<i class="fe uil uil-book-medical"></i> Book Request
					</a>
				</li>
				<li class="nav-item">
					<a href="../student/requested_list.php" class="nav-link 
					<?php if ($nav_role == "requested_list") {
						echo "active";
					} ?>">
						<i class="fe uil uil-book-medical"></i>Requested list
					</a>
				</li>


				<li class="nav-item">
					<a href="../student/penalty.php" class="nav-link 
					<?php if ($nav_role == "Penalty") {
						echo "active";
					} ?>">
						<i class="fe uil-money-withdrawal"></i> Penalty
					</a>
				</li>
			</ul>
			<!-- Divider -->
			<hr class="navbar-divider my-3">
			<!-- Heading -->
			<h6 class="navbar-heading">
				Help Center
			</h6>
			<!-- Navigation -->
			<ul class="navbar-nav mb-md-4">
				<li class="nav-item">
					<a href="query.php" class="nav-link <?php if ($nav_role == "Account related Details") {
															echo "active";
														} ?>">
						<i class="fe fe-user"></i>Queries
					</a>
				</li>
				<li class="nav-item">
					<a href="query_list.php" class="nav-link <?php if ($nav_role == "All querys") {
																	echo "active";
																} ?>">
						<i class="fe fe-user"></i>Queries List
					</a>
				</li>
			</ul>

			<div class="mt-auto"></div>




			<!-- User (md) -->
			<div class="navbar-user d-md-flex" style="overflow: hidden;" id="sidebarUser">

				<hgroup class="text-center navbar-heading " style="margin: -30px;">
					<a href="logout.php"><button class="btn btn-link">Logout</button></a>
					<h6 style="margin: -1px;">
						Version 1.0.0
					</h6>
					<h6 class="">
						Developed By <a style="color: #1A68D1;" href="http://titanslab.in/" target="_blank">Titanslab</a>
					</h6>
				</hgroup>
			</div>
		</div>
	</div>
</nav>
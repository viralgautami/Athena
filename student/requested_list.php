<?php
session_start();
if ($_SESSION['role'] != "Law") {
    header("Location: ../index.php");
} else {
    include_once("../config.php");
    $_SESSION["userrole"] = "Student";
    $id = $_SESSION['id'];
    $bqur = "SELECT * FROM book_request where s_id = '$id'";
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
    <?php $nav_role = "requested_list"; ?>
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
                                        Borrows List
                                    </h1>
                                </div>
                            </div>
                            <!-- / .row -->
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Nav -->
                                    <ul class="nav nav-tabs nav-overflow header-tabs">
                                        <li class="nav-item">
                                            <a href="#!" class="nav-link text-nowrap active">
                                                All Borrows <span class="badge rounded-pill bg-soft-secondary"><?php echo $brow ?></span>
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
                                                        <a class="list-sort text-muted" data-sort="item-name">Book Name</a>
                                                    </th>
                                                    <th>
                                                        <a class="list-sort text-muted" data-sort="item-email">Author Name</a>
                                                    </th>
                                                    <th>
                                                        <a class="list-sort text-muted" data-sort="item-phone">Publisher</a>
                                                    </th>
                                                    <th>
                                                        <a class="list-sort text-muted" data-sort="item-phone">Status</a>
                                                    </th>
                                                    <th>
                                                        <a class="list-sort text-muted" data-sort="item-phone">Action</a>
                                                    </th>
                                                    <th>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list font-size-base">
                                                <?php
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($bqurres)) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <span class="item-email text-reset"><?php echo $i++; ?></span>
                                                        </td>
                                                        <td>
                                                            <a class="item-name text-reset"><?php echo $row['book_name']; ?></a>
                                                        </td>
                                                        <td>
                                                            <!-- Email -->
                                                            <span class="item-email text-reset"><?php echo $row['b_author']; ?></span>
                                                        </td>
                                                        <td>
                                                            <!-- Phone -->
                                                            <span class="item-phone text-reset"><?php echo $row['b_publisher']; ?></span>
                                                        </td>
                                                        <td>
                                                            <!-- Phone -->
                                                            <span class="item-phone text-reset">
                                                                <?php
                                                                $a = $row['status'];
                                                                if ($a == 1) { ?>
                                                                    <span class="badge bg-soft-success">Approved</span>
                                                                <?php
                                                                } else if ($a == 2) { ?>
                                                                    <span class="badge bg-soft-danger">declined</span>
                                                                <?php
                                                                }
                                                                ?></span>
                                                        </td>
                                                        <td>
                                                            <a href="delete_req.php?id=<?php echo $row['id']; ?>" onclick="if (! confirm('Are you sure ?')) return false;" class="btn btn-sm btn-danger">
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
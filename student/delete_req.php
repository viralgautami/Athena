<!DOCTYPE html>

<body>
    <?php
    session_start();
    if ($_SESSION['role'] != "Law") {
        header("Location: ../index.php");
    } else {
        include_once("../config.php");
        $_SESSION["userrole"] = "Student";
        $id = $_SESSION['id'];
        $borrow_id = $_GET['id'];
        $bqur = "DELETE FROM book_request where id = '$borrow_id'";
        $run = mysqli_query($conn, $bqur);
        if ($run) {
            echo "<script>alert('Deleted Successfully');</script>";
            header("Location: requested_list.php");
        }
    }
    ?>
</body>

</html>
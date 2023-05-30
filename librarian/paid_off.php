<!DOCTYPE html>

<body>
    <?php
    session_start();
    if ($_SESSION['role'] != "Texas") {
        header("Location: ../index.php");
    } else {
        include_once("../config.php");
        $_SESSION["userrole"] = "Librarian";
        $id = $_SESSION['id'];
        $borrow_id = $_GET['id'];
        
        $updatebook = "UPDATE student_master SET penalty = '0' where S_id = '$borrow_id'";
        $run = mysqli_query($conn, $updatebook);
        if ($run) {
            echo "<script>alert('Paid Successfully');</script>";
            header("Location: penalty.php");
        }
    }
    ?>
</body>

</html>
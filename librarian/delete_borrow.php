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
        $dqur = "DELETE FROM borrow_book WHERE borrow_book_id = '$borrow_id'";
        $bqur = "SELECT * FROM borrow_book where borrow_book_id = '$borrow_id'";
        $bqurres = mysqli_query($conn, $bqur);
        $bqurrow = mysqli_fetch_assoc($bqurres);
        $bookid = $bqurrow['book_id'];
        $bqur = "SELECT * FROM book where B_id = '$bookid'";
        $bqurres = mysqli_query($conn, $bqur);
        $bqurrow = mysqli_fetch_assoc($bqurres);
        $bava = $bqurrow['book_ava'];
        $bookaval = $bava + 1;
        $updatebook = "UPDATE book SET book_ava = '$bookaval' where B_id = '$bookid'";
        $updatebookres = mysqli_query($conn, $updatebook);

        $run = mysqli_query($conn, $dqur);
        if ($run) {
            echo "<script>alert('Deleted Successfully');</script>";
            header("Location: borrow_list.php");
        }
    }
    ?>
</body>

</html>
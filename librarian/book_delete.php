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
        $book_id = $_GET['bookid'];
        $dqur = "DELETE FROM book WHERE book_id = '$book_id'";

        $run = mysqli_query($conn, $dqur);
        if ($run) {
            echo "<script>alert('Deleted Successfully');</script>";
            header("Location: book.php");
        }
    }
    ?>
</body>

</html>
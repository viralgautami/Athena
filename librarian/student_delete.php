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
        $stdid = $_GET['stdid'];
        $bqur = "SELECT * FROM student_master where S_id = '$stdid'";
        $bqurres = mysqli_query($conn, $bqur);
        $bqurrow = mysqli_fetch_assoc($bqurres);
        if ($bqurrow['Penalty'] == 0) {
            $dqur = "DELETE FROM student_master WHERE S_id = '$stdid'";
            $run = mysqli_query($conn, $dqur);
            if ($run) {
                echo "<script>alert('Deleted Successfully');</script>";
                header("Location: ../librarian/student.php");
            }
        } else {
            echo "<script>alert('Student has a penalty');</script>";
            header("Location: ../librarian/student.php");
        }
    }
    ?>
</body>

</html>
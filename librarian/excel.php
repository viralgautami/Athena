<div class="card">
    <div class="card-header">

        <h4 class="card-header-title">
            Error
        </h4>
        <p>
    </div>
    <div class="card-body">
        If Error Occurs Please Check Your Excel File There Might Be Duplicate Entry Or Wrong Data
    </div>
    <a href="student.php">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary">
            Go Back
        </button>
    </a>
    <?php
    session_start();
    include_once("../config.php");
    include_once("../head.php");
    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if (isset($_POST['subbed'])) {
        $fileName = $_FILES['excelfile']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed_ext = ['xls', 'csv', 'xlsx'];

        if (in_array($file_ext, $allowed_ext)) {
            $inputFileNamePath = $_FILES['excelfile']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $count = "0";
            foreach ($data as $row) {
                if ($count > 0) {
                    $senr = $row[0];
                    $senr = strtoupper($senr);
                    $susername = $senr;
                    $spassword = $row[1];
                    $fname = $row[2];
                    $mname = $row[3];
                    $lname = $row[4];
                    $scontact = $row[5];
                    $semail = $row[6];
                    $address = $row[7];
                    $sem = $row[8];
                    $branch = $row[9];
                    $fs_name = "default.png";
                    $date = date("Y-m-d H:i:s");
                    if ($senr != null) {
                        $sql = "INSERT INTO student_master (S_id,Username,spassword, firstname, middlename, lastname, contact, Email, saddress, user_image, s_added,sem,branch) 
	VALUES ('$senr','$susername','$spassword','$fname','$mname','$lname','$scontact','$semail','$address','$fs_name','$date','$sem','$branch');";
                        $result = mysqli_query($conn, $sql);
                    }
                    $msg = true;
                } else {
                    $count = "1";
                }
            }

            if (isset($msg)) {
                echo "<script>alert('Successfully Imported')</script>";
                echo "<script>window.open('student.php','_self')</script>";
            } else {
                echo "<script>alert('error')</script>";
                echo "<script>window.open('student.php','_self')</script>";
            }
        } else {
            $_SESSION['message'] = "Invalid File";
            echo "<script>window.open('student.php','_self')</script>";
        }
    }
    ?>
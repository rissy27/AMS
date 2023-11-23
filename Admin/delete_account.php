
<?php
include "connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM employee_account WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: dashboard.php?success=Deleted Successfully');
    } else {
        die(mysqli_error($conn));
    }
}
?>

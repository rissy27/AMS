<?php
include "connect.php";

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    // JavaScript confirmation pop-up
    echo '<script>
        if (confirm("Are you sure you want to delete this account?")) {
            window.location.href = "delete_account.php?id=' . $id . '";
        } else {
            window.location.href = "dashboard.php";
        }
    </script>';
}

?>


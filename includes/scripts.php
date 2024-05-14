<?php
session_start();
include 'connect.php';

?>

<script src="js/sweetalert.min.js"></script>

<?php
if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    echo "<script>
        swal({
            title: '" . $_SESSION['status'] . "',
            icon: '" . $_SESSION['status_code'] . "',
            button: 'OK',
        });
    </script>";

    if (isset($_SESSION['dangermode'])) {
        echo "<script>
            swal({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this imaginary file!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    swal('Poof! Your imaginary file has been deleted!', {
                        icon: 'success',
                    }).then(() => {
                        // Redirect to index.php after successful deletion
                        window.location.href = 'index.php';
                    });
                } else {
                    swal('Your imaginary file is safe!');
                }
            });
        </script>";
    }

    // Unset session variables after the alerts have been shown
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
    unset($_SESSION['dangermode']);
}
?>

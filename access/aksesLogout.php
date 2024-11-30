<?php 
// session_start();
// session_unset();
// session_destroy();
    if ($user->loGout()) {
        echo "<script>window.location.href='index.php?access=logout&cek=logout'</script>";
    }
?>



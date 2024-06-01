<?php
    $start = 1;

    if (isset($_GET['page'])) {
        $start = ($_GET['page'] * 10) - 9;
    }
?>
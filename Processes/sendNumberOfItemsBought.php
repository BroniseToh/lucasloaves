<?php
session_start();
if(isset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']))
    echo $_SESSION['NUMBER_OF_ITEMS_BOUGHT'];
?>
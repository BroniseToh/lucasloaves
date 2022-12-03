<?php
session_start();

echo json_encode($_SESSION['ARRAY_ORDERS']);
?>
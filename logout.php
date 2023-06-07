<!-- Hủy tất cả các phiên -->
<?php
require 'config/constants.php';
session_destroy();
header('location: '. ROOT_URL);
die();
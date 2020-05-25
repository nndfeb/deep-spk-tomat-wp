<?php
session_start();
//session terdaftar, saatnya logout
session_unset();
session_destroy();
header("Location: index.php");

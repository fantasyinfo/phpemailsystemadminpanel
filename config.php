<?php

define('dbHost', 'localhost');
define('dbUserName', 'root');
define('dbPassWord', 'mysql');
define('dbName', 'gmailsystem');





$conn = mysqli_connect(dbHost, dbUserName, dbPassWord, dbName) or die();
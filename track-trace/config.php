<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "root"; 	/* Add Your Database Username Here */
$password   = ""; 		/* Add Database User Password Here */
$dbname     = "test"; 	/* Add Database Name Here */
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
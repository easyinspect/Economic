<?php
/**
 * Created by PhpStorm.
 * User: mbs
 * Date: 01-09-2017
 * Time: 14:00
 */

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

require 'classes/economicCustomer.php';
require 'vendor/autoload.php';

?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Layout for Economic Library</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grid.css" rel="stylesheet">
</head>

<body>
<div class="container">

    <h1>Economic Library</h1>

    <h3>Kunder</h3>
    <p>I denne sektion kan du tilføje, redigere og fjerne dine nuværende E-conomic kunder ved hjælp af deres API.</p>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <?php
            $economicCustomer = new economicCustomer();
            $economicCustomer->customerShow();
        ?>
    </div>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>


</body></html>

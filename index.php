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

    <h3>Units</h3>
    <p>I denne sektion kan du tilføje, redigere og fjerne dine nuværende E-conomic Units ved hjælp af deres API.</p>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <?php

            $economicApi = new economicApi();

            /*if(isset($_GET['deleteUnit'])) {
                $economicApi->Delete('https://restapi.e-conomic.com/units/', $_GET['deleteUnit']);
            }*/

            foreach($economicApi->Show('https://restapi.e-conomic.com/units/') as $key => $value) {

                $data = get_object_vars($value);
                $id = $data['unitNumber'];
                echo $data['unitNumber']. ' - ' . $data['name'] . ' <a href="?deleteUnit='.$id.'">Slet</a><br/>';
            }


            if(isset($_GET['newUnit'])) {
                ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Navn</label>
                        <input type="text" name="name" class="form-control" placeholder="Navn">
                    </div>
                    <div class="form-group">
                        <label>Navn</label>
                        <input type="text" name="name" class="form-control" placeholder="Navn">
                    </div>
                    <div class="form-group">
                        <label>Navn</label>
                        <input type="text" name="name" class="form-control" placeholder="Navn">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php
            }
            else {
                ?>
                <a href="?newUnit">Ny enhed?</a>
                <?php
            }
        ?>
    </div>

</div> <!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>
</html>

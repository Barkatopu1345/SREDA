<?php
include_once 'dbConfig.php';

if(isset($_POST["insert"]) ){
	
    $eSource = $_POST["esource"];
    $eConsumption = $_POST["econsumption"];
    $eAnnualOp = $_POST["eannualop"];
    $eAnnualPro = $_POST["eannualpro"];
    
   // echo $finYear." ".$yearlyInput." ".$gdpInBillions." ".$source;
	$sql = "INSERT INTO existing_energy (energy_source,energy_con_per_hour,annual_operation_per_hour,annual_production) VALUES
            ('$eSource','$eConsumption','$eAnnualOp', '$eAnnualPro')";
    if(mysqli_query($con, $sql)){
    	echo "Existing Energy Records added successfully.";
	} else{
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Summer 2020</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="d-flex" class="wrapper">
        <!-- Sidebar -->
        <div class=" bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Project </div>
            <div class="bg-dark list-group list-group-flush">
            <a href="index.php" class="list-group-item list-group-item-action bg-dark">Dashboard</a>
            <a href="projectdata.php" class="list-group-item list-group-item-action bg-dark">Project Data</a>
            <a href="gdp.php" class="list-group-item list-group-item-action bg-dark">GDP Data</a>
            <a href="existingEnergy.php" class="list-group-item list-group-item-action bg-dark">Existing Energy Data</a>
            <a href="esExistingEnergy.php" class="list-group-item list-group-item-action bg-dark">Estimated Existing Energy Data</a>
            <a href="actualEnergy.php" class="list-group-item list-group-item-action bg-dark">Actual Existing Energy Data</a>
            <a href="sectorWise.php" class="list-group-item list-group-item-action bg-dark">Sector Wise Data</a>
            <a href="equipmentlist.php" class="list-group-item list-group-item-action bg-dark">Equipment Data</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
            <div class="container-fluid">

                    <!-- Content here -->
                    <h1 class="text-center mb-5">Existing Energy Data Entry Form</h1>
                   
                    <form method="POST">

                        <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label for="inputGDPBill" class="col-sm-2 col-form-label">Energy Source</label>
                                <div class="col-sm-5">
                                <textarea class="form-control" name="esource" rows="2" required></textarea>
                                </div>
                            </div>

                        <div class="form-group row">
                            <div class="col-sm-2">   </div>
                            <label for="inputFinYear" class="col-sm-2 col-form-label">Energy consumption Per Hour</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="econsumption" placeholder="Ex. 1125.23" required>
                            </div>
                        
                        </div>

                        <div class="form-group row">
                        <div class="col-sm-2"></div>
                            <label for="inputGDPBill" class="col-sm-2 col-form-label">Annual Operation Per Hour</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="eannualop" placeholder="Annual Operation Per Hour" required>
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-sm-2"></div>
                            <label for="inputGDPBill" class="col-sm-2 col-form-label">Annual Production</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="eannualpro" placeholder="Annual Production" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                
                            </div>
                            <div class="col-sm-5">
                            <button type="submit" name="insert" class="btn btn-primary btn-lg btn-block">Submit Data</button>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <div class="container-fluid mt-5">

                        <?php
                            $sql = "SELECT * FROM existing_energy"; 
                            $result = mysqli_query($con, $sql); 
                        ?>
                           <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                <tr>
                                <th>No.</th>
                                <th>Energy Source</th>
                                <th>Energy Consumption Per Hour</th>
                                <th>Annual Operation Per Hour</th>
                                <th>Annual Production</th>
                                </tr>
                                <?php
                                while($row = mysqli_fetch_array($result))
                                {
                                echo '
                                <tr>
                                <td>'.$row["eEnergy_id"].'</td>
                                <td>'.$row["energy_source"].'</td>
                                <td>'.$row["energy_con_per_hour"].'</td>
                                <td>'.$row["annual_operation_per_hour"].'</td>
                                <td>'.$row["annual_production"].'</td>
                                </tr>
                                ';
                                }
                                ?>
                                </table>
                            </div>
                            </div>           


            </div>
        </div>
        <!-- /#page-content-wrapper -->
    
        </div>
        <!-- /#wrapper -->
    </div>

    <div class="main">

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>









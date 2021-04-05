<?php
include_once 'dbConfig.php';

 $actualAnnualProduction=0;
 $estimatedAnnualProduction=0;
 $existingAnnualProduction=0;
    
if(isset($_POST["insert"]) ){
    
    $pId =$_POST["pid"];
    $pName = $_POST["pname"];
    $pSector = $_POST["psector"];
    $pAmount = $_POST["pamount"];
    

    $getActualEnergyData = "SELECT annual_production FROM actual_energy_data WHERE aEnergy_id=$pId";
    $result1 = mysqli_query($con, $getActualEnergyData); 
    while($row = mysqli_fetch_assoc($result1)) { 
        $actualAnnualProduction = $row["annual_production"];
    } 
    
    $getEstimatedData = "SELECT annual_production FROM estimated_energy_data WHERE esEnergy_id=$pId";
    $result2 = mysqli_query($con, $getEstimatedData); 
    while($row = mysqli_fetch_assoc($result2)) { 
        $estimatedAnnualProduction = $row["annual_production"];
    } 

    $getExistingEnergyData = "SELECT annual_production FROM existing_energy WHERE eEnergy_id=$pId";
    $result3 = mysqli_query($con, $getExistingEnergyData); 
    while($row = mysqli_fetch_assoc($result3)) { 
        $existingAnnualProduction = $row["annual_production"];
    } 



	$sql = "INSERT INTO project_data (pro_name,pro_sector,pro_amount,existing_energy,estimated_energy,actual_energy,equipment) VALUES
            ('$pName','$pSector','$pAmount', '$existingAnnualProduction','$estimatedAnnualProduction','$actualAnnualProduction','')";
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
                    <h1 class="text-center mb-5">Project Data Entry Form</h1>
                   
                    <form method="POST">


                         <div class="form-group row">
                            <div class="col-sm-2">   </div>
                            <label for="inputFinYear" class="col-sm-2 col-form-label">Project Id</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="pid" placeholder="Ex. 1,2,.." required>
                            </div>
                        
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">   </div>
                            <label for="inputFinYear" class="col-sm-2 col-form-label">Project Name</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="pname" placeholder="Project name" required>
                            </div>
                        
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-2">   </div>
                            <label for="inputFinYear" class="col-sm-2 col-form-label">Project Sector</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="psector" placeholder="Project sector" required>
                            </div>
                        
                        </div>

                        <div class="form-group row">
                        <div class="col-sm-2"></div>
                            <label for="inputGDPBill" class="col-sm-2 col-form-label">Amount in Million</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" name="pamount" placeholder="Amount in million" required>
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
                            $sql = "SELECT * FROM project_data"; 
                            $result = mysqli_query($con, $sql); 
                        ?>
                           <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                <tr>
                                <th>No.</th>
                                <th>Project Name</th>
                                <th>Project Sector</th>
                                <th>Project Amount</th>
                                <th>Existing Energy (Annual Pro.)</th>
                                <th>Estimated Energy (Annual Pro.)</th>
                                <th>Actual Energy (Annual Pro.)</th>
                                </tr>
                                <?php
                                while($row = mysqli_fetch_array($result))
                                {
                                echo '
                                <tr>
                                <td>'.$row["pro_id"].'</td>
                                <td>'.$row["pro_name"].'</td>
                                <td>'.$row["pro_sector"].'</td>
                                <td>'.$row["pro_amount"].'</td>
                                <td>'.$row["existing_energy"].'</td>
                                <td>'.$row["estimated_energy"].'</td>
                                <td>'.$row["actual_energy"].'</td>
                                </tr>
                                ';
                                }
                                ?>
                                </table>
                            </div>
                            </div>              
                        
                    </div> <!-- End--->

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









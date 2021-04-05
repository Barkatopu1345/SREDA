<?php
$dataPoints = array();
$dataPoints2 = array();
$equipment_datapoints = array();
$gdp_datapoints=array();
$numberProjects=0;
$totalLoanAmount=0;
$totalEquipments=0;
$totalEquipmentCost=0;

try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new PDO('mysql:host=localhost;dbname=project', 'root', '');
     
    //----------------Sector wise
    $handle = $link->prepare("select * from sector_wise_data"); 
    $handle->execute(); 
    $result = $handle->fetchAll(PDO::FETCH_OBJ);
    
    
    foreach($result as $row){
        //for line & column
        array_push($dataPoints, array("label"=>$row->project_name, "y"=>$row->avg_amount_per_project));
        array_push($dataPoints2, array("label"=>$row->project_name, "y"=>$row->total_loan_amount));
        $numberProjects+= $row->no_of_projects; // $numberProjects=$numberProjects+ $row->no_of_projects;
        $totalLoanAmount+=$row->total_loan_amount;
       // array_push($dataPoints2, array("label"=>$row->project_name, "y"=>$row->no_of_projects));
      //  array_push($dataPoints3, array("label"=>$row->project_name, "y"=>$row->total_loan_amount));

    }
    //---------------------------
    //----------------Equipment List
    $equip_handle =$link->prepare("select * from equipment_list"); 
    $equip_handle->execute();
    $eq_result =$equip_handle->fetchAll(PDO::FETCH_OBJ);
    $count=0;
    foreach($eq_result as $row){
        array_push($equipment_datapoints, array("label"=>$row->equipment_name, "y"=>$row->equip_amount));
       $count++;
       $totalEquipmentCost+=$row->equip_amount;
    }

    $totalEquipments=$count;
    //------------------------------------------------
    //---------------GDP
    $gdp_handle=$link->prepare("select * from gdp"); 
    $gdp_handle->execute();
    $gdp_result = $gdp_handle->fetchAll(PDO::FETCH_OBJ);
    foreach($gdp_result as $row){
        array_push($gdp_datapoints, array("label"=>$row->fin_year, "y"=>$row->gdp_amount));
    }








    
  $link = null;
 //$option ="";
}
catch(PDOException $ex){
    print($ex->getMessage());
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

    <script>
            window.onload = function () {
            
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Project Sector Wise"
                },
                axisY: {
                    title: "Total loan amount"
                },
                data: [
                {
                    type: "column",
                    indexLabel: "{y}",
	            	yValueFormatString: "#0.##B",
		            showInLegend: true,
		            legendText: "B = Billion",
                    //yValueFormatString: "#,##0.## tonnes",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });


            chart.render();

           var equip_pie_chart = new CanvasJS.Chart("piechartContainer_eq", {
                        animationEnabled: true,
                        //exportEnabled: true,
                        title: {
                            text:  "Equipment	Amount in Million BDT"
                        },
                        axisY: {
                            //title: ""
                        },
                        data: [{
                            type: "pie",
                            yValueFormatString: "#,##0.00\"%\"",
	                    	indexLabel: "{label} ({y})",
                            dataPoints: <?php echo json_encode($equipment_datapoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    equip_pie_chart.render();

            var equip_area_chart = new CanvasJS.Chart("areachartContainer_eq", {
                animationEnabled: true,
                //exportEnabled: true,
                title: {
                    text:  "Equipment	Amount in Million BDT"
                },
                axisY: {
                    //title: ""
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##B",
                    showInLegend: true,
		            legendText: "B = Billion",
                    dataPoints: <?php echo json_encode($equipment_datapoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            equip_area_chart.render();

            var gdp_bar_chart = new CanvasJS.Chart("gdp_container", {
                animationEnabled: true,
                //exportEnabled: true,
                title: {
                    text:  "Financial Year"
                },
                axisY: {
                    title: "GDP Amount"
                },
                data: [{
                    type: "line",
                    indexLabel: "{y}",
                    yValueFormatString: "#0.##B",
                    showInLegend: true,
		            legendText: "B = Billion",
                    dataPoints: <?php echo json_encode($gdp_datapoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            gdp_bar_chart.render();
            
     }
</script>
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
            
                <div class="row ">
                    <div class="col-md-3 box boxColor1">
                        <h6>No. Projects <?php echo $numberProjects?></h6>
                        <p></p>
                        <h6>Total Loan Amoun <?php echo $totalLoanAmount." Million BDT"?></h6>
                    </div>
                    <div class="col-md-3 box boxColor2">

                        <h6>Total Equipments <?php echo $totalEquipments?></h6>
                        <p></p>
                        <h6>Total Cost <?php echo $totalEquipmentCost." Million BDT"?></h6>
                    </div>
                    <div class="col-md-3 box boxColor3">
                        <h6>No. Pipeline 10</h6>
                        <p></p>
                        <h6>Total Cost 20</h6>
                    </div>
                    <div class="col-md-3 box boxColor4">
                        <h6>No. Tecnology 10</h6>
                        <p></p>
                        <h6>Total Cost 10</h6>
                    </div>
                </div>
                <p></p>
                <hr>
                <p></p>
                <div class="container-fluid">
               
                    <div class="row">

                        <div class="col-md-12">
                            <h6 class="mt-4">Financial GDP</h6>
                            
                            <div id="gdp_container" style="height: 300px; width: 100%;"></div>
                        </div>

                        <div class="col-md-12">
                            <h6 class="mt-4">Sector Wise Data</h6>
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>

                      

                       
                    </div>
                    <p></p>
                    <div class="row">
                        <h6>Equipment wise distribution charts </h6>
                        <div class="col-md-12 mt-4">
                            
                            <div id="piechartContainer_eq" style="height: 300px; width: 100%;"></div>
                        </div>
                        <div class="col-md-12 mt-4">
                            
                            <div id="areachartContainer_eq" style="height: 300px; width: 100%;"></div>
                        </div>
                        
                       
                    </div>
                     <!---Graph API ---> 
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>   
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
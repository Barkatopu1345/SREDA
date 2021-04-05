<?php
 $dataPoints = array();
 $dataPoints2 = array();
 $dataPoints3 = array();


 try{
      // Creating a new connection.
     // Replace your-hostname, your-db, your-username, your-password according to your database
     $link = new PDO('mysql:host=localhost;dbname=project', 'root', '');
      
 
     $handle = $link->prepare("select * from sector_wise_data"); 
     $handle->execute(); 
     $result = $handle->fetchAll(PDO::FETCH_OBJ);
     
     
     foreach($result as $row){
 
         array_push($dataPoints, array("label"=>$row->project_name, "y"=>$row->avg_amount_per_project));
         array_push($dataPoints2, array("label"=>$row->project_name, "y"=>$row->no_of_projects));
         array_push($dataPoints3, array("label"=>$row->project_name, "y"=>$row->total_loan_amount));
 
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
                    text: "No. of Proponents and avg loan amount"
                },
                axisY: {
                    //title: ""
                },
                data: [
                {
                    type: "column",
                    //yValueFormatString: "#,##0.## tonnes",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                },
                {
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });


            chart.render();

            var chart2 = new CanvasJS.Chart("chartContainer1", {
                        animationEnabled: true,
                        //exportEnabled: true,
                        title: {
                            text:  "Loan amount Distribution(million BDT)"
                        },
                        axisY: {
                            //title: ""
                        },
                        data: [{
                            type: "pie",
                            dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart2.render();
            
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
            <a href="graph.php" class="list-group-item list-group-item-action bg-dark">Graph</a>

            </div>
        </div>
        <!-- /#sidebar-wrapper -->
    
            <div class="container-fluid">
            <h1 class="mt-4">Sector Wise Data</h1>
                <div class="row">
                    <div class="col-md-6">
                         <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
               
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>   
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
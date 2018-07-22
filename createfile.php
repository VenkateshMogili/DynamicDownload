<?php
require 'connect.php';
$id=$_GET['id'];//user identification
$q=mysqli_query($con,"SELECT * FROM students where stuid='$id'");
while($row2=mysqli_fetch_array($q))
{
  $stuid=$row2['stuid'];
  $name=$row2['s_name'];
  $email=$row2['s_email'];
  $dob=$row2['s_dob'];
}

//Column Fields and Row Fields to display in CSV file
$data = array(
       '0' => array('ID'=> $name, 'Name' =>$stuid, 'Email' =>$email,'DOB' =>$dob)
      );

//form validation to create csv file with data
if(isset($_POST["ExportType"]))
{
   
    switch($_POST["ExportType"])
    {
    case "export-to-csv" :

      $filename = $id . ".csv";   //creating filename as userid.csv
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-type: text/csv");
      header("Content-Disposition: attachment; filename=\"$filename\"");
      ExportCSVFile($data);
            exit();
        default :
            die("Unknown action : ".$_POST["action"]);
            break;
    }
}

function ExportCSVFile($records) {
  // create a file pointer connected to the output stream
  $fh = fopen( 'php://output', 'w' );
  $heading = false;
    if(!empty($records))
      foreach($records as $row) {
      if(!$heading) {
        // output the column headings
        fputcsv($fh, array_keys($row));
        $heading = true;
      }
      // loop over the rows, outputting them
       fputcsv($fh, array_values($row));
       
      }
      fclose($fh);
}
?>
<body onload="setTimeout(function(){alert('Downloaded Successfully...');window.close()},3000)">
<center><h3>Downloading....</h3></center>
<div style="display:none"><a href="javascript:void(0)" id="export-to-csv">Export to csv</a>
<form action="" method="post" id="export-form">
 <input type="hidden" value='' id='hidden-type' name='ExportType'/>
   </form>
</div>
<script src="jquery-1.9.1.min.js"></script>
<script  type="text/javascript">
$(window).load(function() {
//used for file format option
var target = $("#export-to-csv").attr('id');
switch(target) {
 case 'export-to-csv' :
 $('#hidden-type').val(target);
 $('#export-form').submit();
 $('#hidden-type').val('');
 break
  }
});
</script>

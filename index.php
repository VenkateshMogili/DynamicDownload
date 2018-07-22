<title>Creating Files</title>
<link rel="stylesheet" href="bootstrap.css">
<?php
require 'connect.php';
?>
<center><h1>Student Details</h1></center>
<form action="createfile.php" method="post" id="export-form">
   </form>
                  <table id="" class="table table-striped table-bordered" style="width:100%;text-align:left;">
                    <tr style="background-color:lightgray">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Of Birth</th>
                        <th>Download</th>
                  </tr>
                <tbody>
                  <?php 
                  $q=mysqli_query($con,"SELECT * FROM students");

                  foreach($q as $row):?>
   <tr>
   <td><?php echo $row ['stuid']?></td>
   <td><?php echo $row ['s_name']?></td>
   <td><?php echo $row ['s_email']?></td>
   <td><?php echo $row ['s_dob']?></td>
   <td><?php echo "<a href='createfile.php?id=".$row['stuid']."' target='_blank'>Download</a>";?></td>
   </tr>
   <?php endforeach; ?>
                </tbody>
              </table>

<?php
 $message = '';
 $error = '';
 if(isset($_POST["submit"]))
 {
      if(empty($_POST["name"]))
      {
           $error = "<label class='text-danger'>Enter Name</label>";
      }
      else if(empty($_POST["id"]))
      {
           $error = "<label class='text-danger'>Enter id</label>";
      }
      else if(empty($_POST["fname"]))
      {
           $error = "<label class='text-danger'>Enter Father's name</label>";
      }
      else if(empty($_POST["mname"]))
      {
           $error = "<label class='text-danger'>Enter Mother's name</label>";
      }
      else if(empty($_POST["address"]))
      {
           $error = "<label class='text-danger'>Enter address</label>";
      }
      else if(empty($_POST["contact"]))
      {
           $error = "<label class='text-danger'>Enter contact details</label>";
      }
      else
      {
           if(file_exists('employee_data.json'))
           {
                $current_data = file_get_contents('employee_data.json');
                $array_data = json_decode($current_data, true);
                $extra = array(
                     'name'               =>     $_POST["name"],
                     'id'                 =>     $_POST["id"],
                     'fname'              =>     $_POST["fname"],
                     'mname'              =>     $_POST["mname"],
                     'address'            =>     $_POST["address"],
                     'contact'            =>     $_POST["contact"]
                );
                $array_data[] = $extra;
                $final_data = json_encode($array_data);  
                if(file_put_contents('employee_data.json', $final_data))
                {
                     $message = "<br /><label class='text-success'>Details added to records!</p>";
                }
           }
           else
           {
                $error = 'JSON File not exits';
           }
      }
 }
 ?>
 <!DOCTYPE html>
 <html>
      <head>
           <title>Backend</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      </head>
      <body>
           <div class="container" style="width:500px;">
            <br />
                <h3 align="">Admin Portal | <a href="student portal.html">Student Portal</a></h3><br />
                <form method="post">
                     <?php
                     if(isset($error))
                     {
                          echo $error;
                     }
                     ?>
                     <label>Name</label>
                     <input type="text" name="name" class="form-control" /><br />
                     <label>ID</label>
                     <input type="text" name="id" class="form-control" /><br />
                     <label>Father's name</label>
                     <input type="text" name="fname" class="form-control" /><br />
                     <label>Mother's name</label>
                     <input type="text" name="mname" class="form-control" /><br />
                     <label>Address</label>
                     <input type="text" name="address" class="form-control" /><br />
                     <label>Contact</label>
                     <input type="text" name="contact" class="form-control" /><br /><br />
                     <input type="submit" name="submit" value="Add to records" class="btn btn-info" /><br />
                     <?php
                     if(isset($message))
                     {
                          echo $message;
                     }
                     ?>
                </form>
           </div>
           <br />
      </body>
 </html>

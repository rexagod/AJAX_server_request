<?php
 $message = '';
 $error = '';
 if(isset($_POST["submit"]))
 {
      if(empty($_POST["id"]))
      {
           $error = "<label class='text-danger'>Enter Id</label>";
      }
      else if(empty($_POST["fees"]))
      {
           $error = "<label class='text-danger'>Enter fee status</label>";
      }
      else
      {
           if(file_exists('employee_data_dynamic.json'))
           {
                $current_data = file_get_contents('employee_data_dynamic.json');
                $array_data = json_decode($current_data, true);

                    $extra = array(
                     'id'                 =>     $_POST["id"],
                     'fees'               =>     $_POST["fees"]
                );
                $array_data[] = $extra;
                $final_data = json_encode($array_data);
                if(file_put_contents('employee_data_dynamic.json', $final_data))
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
           <div class="container" style="width:500px; position: relative;">
            <br />
                <h3 align=""><a href = "append_json_data.php">Admin Portal</a> | <a href="student_portal.html">Student Portal</a></h3><br />
                <form method="post">
                     <?php
                     if(isset($error))
                     {
                          echo $error;
                     }
                     ?>
                     <label>Enter student Id</label>
                     <input type="text" id="id" name="id" class="form-control" /><br />
                     <label>Fee Status</label><br />
                     <input type="text" id="fees" name="fees" class="form-control" /><br />
                     <!-- <label>Absents</label><br /> -->
                     <!-- <input type="text" name="abs" class="form-control" /><br />
                     <label>Marks</label><br />
                     <input type="text" name="marks" class="form-control" /><br /> -->
                     <input type="submit" name="submit" value="Update" class="btn btn-info" style="position: absolute;top: 260px;" /><br />

                     <?php
                     if(isset($message))
                     {
                          echo $message;
                     }
                     ?>
                </form>
                <button class="btn btn-info" style="position: absolute; right: 15px;top: 260px;" onclick="myDynamic()">Find by Id</button>
           </div>
      </body>
      <script type="text/javascript">

        function myDynamic(){

    var x,y;
    var xx;

    x = document.getElementById('id').value; //entered studentId

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
      if (this.status == 200 && this.readyState == 4) {

        xx = JSON.parse(this.responseText);

        for (y=(xx.length-1); y>=0; y--) {

          if(xx[y].id == x) {

            document.getElementById('fees').value = xx[y].fees;

          }

        }

      }
    }

    xhttp.open("GET","employee_data_dynamic.json",true);
    xhttp.send();

  }
      </script>
 </html>

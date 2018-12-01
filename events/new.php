<html>
<head>
<?php
include "../main/header.html"; 
?>
</head>    
<body>
<div class='container'>
<?php
include "../main/navbar.html"; 
?>
  <div  id="content" > 
    <form  method='POST' action="../events/create.php" id="event" >
      <div class="offset-sm-3 col-sm-6">
                <?php 
                require_once "../db/connect.php";
                $sql_students = "select id as 'id_student', name  as 'name_student' FROM students;";
                $sql_teachers = "select id as 'id_teacher', name  as 'name_teacher' FROM teachers;";
                if($students = mysqli_query($db, $sql_students)){
                  if(mysqli_num_rows($students) > 0){
                      echo '<div class="row">';
                      echo '<div class="col-sm-12">';
                      echo '<div class="form-group">';
                      echo '<label for="student_select">Estudiante</label>';
                      echo '<select class="form-control" id="student_select" name="std_id" required >';
                          while($row = mysqli_fetch_array($students)){
                              echo '<option value="' . $row['id_student'] . ' " >' . $row['name_student'] . '</option>';
                          }
                      echo '</select>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                      // Free result set
                      mysqli_free_result($students);
                  } else{
                      echo "<p class='lead'><em>No Students records were found.</em></p>";
                  }
                } else{
                  echo "ERROR: Could not able to execute $sql_students. " . mysqli_error($db);
                }
                if($teachers = mysqli_query($db, $sql_teachers)){
                  if(mysqli_num_rows($teachers) > 0){
                      echo '<div class="row">';
                      echo '<div class="col-sm-12">';
                      echo '<div class="form-group">';
                      echo '<label for="student_select">Estudiante</label>';
                      echo '<select class="form-control" id="teacher_select" name="tch_id" required >';
                          while($row = mysqli_fetch_array($teachers)){
                              echo '<option value="' . $row['id_teacher'] . ' " >' . $row['name_teacher'] . '</option>';
                          }
                      echo '</select>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                      // Free result set
                      mysqli_free_result($teachers);
                  } else{
                      echo "<p class='lead'><em>No Students records were found.</em></p>";
                  }
                } else{
                  echo "ERROR: Could not able to execute $sql_teachers. " . mysqli_error($db);
                }
                 mysqli_close($db);
                ?>
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="usr_time"  class="form-label">Dia</label></br>
                        <input type="checkbox" checked="checked"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="1" id="mon-chckbx" >
                        <label for="mon-chckbx" class="btn btn-default label-btn-wd" >L</label>
                        <input type="checkbox"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="2" id="tu-chckbx">
                        <label for="tu-chckbx" class="btn btn-default label-btn-wd" >M</label>
                        <input type="checkbox"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="3" id="wed-chckbx">
                        <label for="wed-chckbx" class="btn btn-default label-btn-wd" >M</label>
						            <input type="checkbox"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="4" id="thu-chckbx">
                        <label for="thu-chckbx" class="btn btn-default label-btn-wd" >J</label>
                        <input type="checkbox"  class="chckbx-btn-day  chckbx-btn-wd" name="dow_number" value="5" id="fri-chckbx">
                        <label for="fri-chckbx" class="btn btn-default label-btn-wd" >V</label>
                        <input type="checkbox"  class="chckbx-btn-day" name="dow_number" value="0" id="other-chckbx">
                        <label for="other-chckbx" class="btn btn-default label-btn-wd" >...</label>
                        <input class="form-control" type="date" id='datePicker' name="date"  value="<?php echo date('Y-m-d'); ?>" min=<?php echo date('Y-m-d'); ?> >
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="usr_time"  class="form-label">Hora Inicio</label>
                        <input class="form-control" required type="time" value="12:00:00" name="start_time" id="start_time"  step="1800" min="08:00:00" max="22:00:00">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="usr_time"  class="form-label">Hora Final</label>
                        <input class="form-control" required type="time" value="13:00:00" name="end_time"  id="end_time" step="1800" max="22:00:00" >
                    </div>
                </div>                  
              </div>
              <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                      <button type="submit"  class="btn btn-info">Guardar</button>
                    </div>
                </div>             
              </div>                
      </div>
    </form>
  </div>
</div>
</body>
</html>    
    


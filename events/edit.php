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
    <form  method='POST' action="../events/update.php" id="event" novalidate>
      <div class="offset-sm-3 col-sm-6">
            <?php 
            if(isset($_GET["id"]) && !empty($_GET["id"])){
                require_once "../db/connect.php";
                $input_id = $_GET["id"];
                $sql_events = "select a.id as 'event_id', date(a.start_date) as 'date' , s.id as 'student_id_selected',  t.id as 'teacher_id_selected', a.start_time, a.end_time, a.notes  FROM appointments a JOIN students s ON a.student_id = s.id JOIN teachers t ON a.teacher_id = t.id where a.id =  " . $input_id;
                $sql_students = "select id as 'student_id', name  as 'student_name' FROM students;";
                $sql_teachers = "select id as 'teacher_id', name  as 'teacher_name' FROM teachers;";
                if($events = mysqli_query($db, $sql_events)){
                    if(mysqli_num_rows($events) == 1){
                        $event = mysqli_fetch_array($events, MYSQLI_ASSOC);
                        $event_id = $event['event_id'];
                        $student_id_selected = $event['student_id_selected'];
                        $teacher_id_selected = $event['teacher_id_selected'];
                        $date       = $event['date'];
                        $start_time = $event['start_time'];
                        $end_time   = $event['end_time'];
                        if($students = mysqli_query($db, $sql_students)){
                        if(mysqli_num_rows($students) > 0){
                            echo  '<input type="hidden" id="id" name="id" value="' . $event_id . '">' ;
                            echo '<div class="row">';
                                echo '<div class="col-md-12">';
                                    echo '<div class="form-group">';
                                        echo '<label for="student_select">Estudiante</label>';
                                        echo '<select class="form-control" id="student_select" name="std_id" required >';
                                        while($row = mysqli_fetch_array($students)){
                                            if( $row['student_id'] == $student_id_selected ){
                                                echo '<option value="' . $row['student_id'] . ' " selected >' . $row['student_name'] . '</option>';   
                                            }else{
                                                echo '<option value="' . $row['student_id'] . ' " >' . $row['student_name'] . '</option>';   
                                            }
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
                                echo '<div class="col-md-12">';
                                    echo '<div class="form-group">';
                                        echo '<label for="student_select">Maestro</label>';
                                            echo '<select class="form-control" id="teacher_select" name="tch_id" required >';
                                            while($row = mysqli_fetch_array($teachers)){
                                                if( $row['teacher_id'] == $teacher_id_selected ){
                                                    echo '<option value="' . $row['teacher_id'] . ' " selected >' . $row['teacher_name'] . '</option>';   
                                                }else{
                                                    echo '<option value="' . $row['teacher_id'] . ' " >' . $row['teacher_name'] . '</option>';   
                                                }
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
                    }else{
                        echo "<p class='lead'><em>No Students records were found.</em></p>";
                    }

                echo '<div class="row">';
                    echo '<div class="col-md-8">';
                        echo '<div class="form-group">';
                        echo '<label for="usr_time"  class="form-label">Dia</label></br>';
                        echo '<input type="checkbox" checked="checked"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="1" id="mon-chckbxecho" >';
                        echo '<label for="mon-chckbx" class="btn btn-default label-btn-wd" >L</label>';
                        echo '<input type="checkbox"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="2" id="tu-chckbx">';
                        echo '<label for="tu-chckbx" class="btn btn-default label-btn-wd" >M</label>';
                        echo '<input type="checkbox"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="3" id="wed-chckbx">';
                        echo '<label for="wed-chckbx" class="btn btn-default label-btn-wd" >M</label>';
						echo '<input type="checkbox"  class="chckbx-btn-day chckbx-btn-wd" name="dow_number" value="4" id="thu-chckbx">';
                        echo '<label for="thu-chckbx" class="btn btn-default label-btn-wd" >J</label>';
                        echo '<input type="checkbox"  class="chckbx-btn-day  chckbx-btn-wd" name="dow_number" value="5" id="fri-chckbx">';
                        echo '<label for="fri-chckbx" class="btn btn-default label-btn-wd" >V</label>';
                        echo '<input type="checkbox"  class="chckbx-btn-day" name="dow_number" value="0" id="other-chckbx">';
                        echo '<label for="other-chckbx" class="btn btn-default label-btn-wd" >...</label>';
                        echo '<input class="form-control" type="date" id="datePicker" name="date"  value="'. $date . '" min='. date("Y-m-d") . '>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-md-6">';
                        echo '<div class="form-group">';
                            echo '<label for="usr_time"  class="form-label">Hora Inicio</label>';
                            echo '<input class="form-control" required type="time" value="' . $start_time . '" name="start_time" id="start_time"  step="1800" min="08:00:00" max="22:00:00">';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                        echo '<div class="form-group">';
                            echo '<label for="usr_time"  class="form-label">Hora Final</label>';
                            echo '<input class="form-control" required type="time" value="' . $end_time . '" name="end_time"  id="end_time" step="1800" max="22:00:00" >';
                        echo '</div>';
                    echo '</div>                  ';
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-md-12">';
                        echo '<div class="form-group">';
                        echo '<button type="submit"  class="btn btn-info">Guardar</button>';
                        echo '</div>';
                    echo '</div>             ';
                echo '</div> '; 

                }else{
                    echo "ERROR: Could not able to execute $sql_events. " . mysqli_error($db);
                }
            }else{
                // URL doesn't contain id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            ?>              
                </div> 
            </form>           
      </div>
    </form>
  </div>
</div>
</body>
</html>    
    




<?php
    include "db.php";
    $path = "r_data.csv";
    $sel_ha = $_POST['ha'];
    $sel_loc = $_POST['loc'];
    $sel_vac = $_POST['vac'];
                  // TODO allow selection of number of doses.
                  $series = array();
                  $index = 0;
                  $vaccines = explode(',',$sel_vac);
                  if(isset($vaccines)){
                    foreach($vaccines as $batches){
                      $series[$index] = array();
                      $vacbat = explode(':', $batches);
                      $vaccine = $vacbat[0];
                      $batch = $vacbat[1];
                      if (strcmp($batch, "*") !== 0) {
                        $batch_query = "'$batch'";
                      }
                      else {
                        $batch_query = '`batch_no`';
                      }
                      if(!$dates = mysqli_query($conn, "SELECT `date` FROM `report` WHERE `v_name` = '$vaccine' AND `batch_no` = $batch_query ")) {
                        echo "Failed to query database for report times!";
                      }
                      else {
                          $series[$index][] = $vaccine.", ".$batch.": ";
                        while ($row = mysqli_fetch_assoc($dates)){
                          $series[$index][] = $row['date'];
                        }
                        # $series[] = $vaccine.",".$batch.";".implode(";", $rows);
                      }
                      $index = $index + 1;
                    }
                    function cmp($a, $b){
                      return count($b) - count($a);
                    }
                    usort($series, "cmp");
                    $transpose = array();
                    foreach($series as $serie) {
                      for ($i = 0; $i <= count($serie) - 1; $i++) {
                        $transpose[$i] = $transpose[$i].$serie[$i].";";
                      }
                    }
                    $transpose = array_map('rtrim',$transpose);
                      # echo "it workedhey!\n";
                      # file_put_contents($r_data_path, implode(PHP_EOL, mysqli_fetch_array($full_dates)));
                      file_put_contents($path, implode(PHP_EOL, $transpose));
                      # $fd_array = mysqli_fetch_row($full_dates);
                      exec("\"C:\Program Files\R\R-4.1.2\bin\Rscript.exe\" C:\MAMP\htdocs\Catwoman-IMS\R\\return_test_output.R $path", $output);
                  }
                  
                    ?>
    <div style = "width:75%; height: 100%; float:left;">
    <?php
      // Execute the R script within PHP code
      // Generates output as test.png image.
      
      
      # echo $output[2];
      // echo $output[1];
      $time = time();
      echo "<img src=\"test.png?$time\" style = \" width: 100%; height: 100%; width: auto\9;\">";
      # if(unlink("\Catwoman-IMS\\".$_GET["test.png"]))
      # echo "File Deleted.";
      ?>
    </div>
        
        <div id = "text" style = "
        height:97%;
        width:23%;
        float:right;
        background-color:white;
        border: 2px solid rgb(104, 104, 104);
        border-radius: 8px;
        margin: 1%;
        padding: 30px;
        color: #000000;
        font-weight: bold;
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-gutter: stable;
        ">
          <?php
            // echo $output[0];
            // echo"<br>";
            // echo $output[1];
            
            echo "Selected parameters: <br> Location: $sel_loc <br> Hospital ID: $sel_ha  <br>Vaccines:<br> $sel_vac";
          ?>
        </div>
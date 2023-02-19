<?php
// session_start();
// // If the user is not logged in redirect to the login page...
// if (empty($_SESSION['hw_loggedin'])) {
//     session_destroy();
// 	header('Location: /Catwoman-IMS/loginpage_worker.html');
// 	exit;
// }
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<?php
include "db.php";
?>
<div style = "height:100vh;overflow:hidden">
  
<head>
  <title>Statistics</title>
  <style>
      /*
  Hide radio button (the round disc)
  we will use just the label to create pushbutton effect
*/
input[type=radio] {
  display: none;
  margin: 0px;
}

/*
  Change the look'n'feel of labels (which are adjacent to radiobuttons).
  Add some margin, padding to label
*/
input[type=radio]+label {
  display: inline-block;
  margin: 2px 0.5%;
  padding: 4px 12px;
  width:49%;
  height:30px;
  float: left;
  background-color: #d0d0d0;
  border-color: #ffffff;
}

/*
 Change background color for label next to checked radio button
 to make it look like highlighted button
*/
input[type=radio]:checked+label {
  background-image: none;
  background-color: #FFFFFF;
}


html,
body {
  height: 100%;
  margin: 0;
}

.boxx {
  display: flex;
  flex-flow: column;
  height: 100%;
}

/* .box .row {
  border: 1px dotted #0313fc;
} */

.boxx .roww.headerr {
  flex: 0 0 197;
}

.boxx .roww.contentt {
  flex: 1 1 auto;
}

.boxx .roww.footerr {
  flex: 0 1 auto;
}

/* Scrollbar styles */

::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

 ::-webkit-scrollbar-track {
    background: #f5f5f5;
    border-radius: 10px;
}

 ::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background: #ccc;
}

 ::-webkit-scrollbar-thumb:hover {
    background: #999;
}

  </style>

  <script>
    function load_new_plot(){
      var sel_ha=$("#ha option:selected").val();
      var sel_loc=$('input[name="location"]:checked').val();
      // var sel_vac = $('input[name="vaccine"]:checked').val();
      // var sel_vac = $('input[name="vaccine"]:checked').map(function() {
      //   return this.value;
      // }).get();
      // var result = $('input[name="vaccine"]:checked');
      // var sel_vac = "hello";
      // $.each($('input[name="vaccine"]:checked'), function(){            
      //   sel_vac.push($(this).val());
      // });
      var values = [];
      $('input[name="vaccine[]"]:checked').each(function(i,v){
        values.push($(v).val());
      });
      var sel_vac = values.join();

    
      // for(var x = 0, l = cbs.length; x < l;  x++)
      //   {
      //       sel_vac.push(cbs[x].value);
      //   }
      $.post("gen_plot.php", {ha:sel_ha, loc: sel_loc, vac:sel_vac},
      function(data){
        $("#plot").html(data);
      }
      );
    }

  </script>

</head>

<!-- Top navigation bar -->
<body>
<div class = "boxx" style = "height:100%;">
  <!-- <div style = "height: 197px"> -->
  <div class = "roww headerr">
  <div class="w3-bar w3-black w3-hide-small">
    <a href="/Catwoman-IMS/healthcareworkerhome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
    <a href="/Catwoman-IMS/registervaccine.php" class = "w3-bar-item w3-button w3-left">Register vaccine</a>
    <a href="/Catwoman-IMS/worker_patients_page.php" class = "w3-bar-item w3-button w3-left">Patients</a> 
    <a href="/Catwoman-IMS/statisticspage.php" class = "w3-bar-item w3-button w3-left">Statistics</a> 
    <a href="/Catwoman-IMS/worker_logout.php" class = "w3-bar-item w3-button w3-right">Log out</a> 
    <a href="/Catwoman-IMS/workerprofilepage.php" class = "w3-bar-item w3-button w3-right">Profile</a> 
  </div>

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Unified Vaccination Platform</b></p>
    </header>
</div>
  </div>
<!-- <div style = "overflow: hidden;
    position: relative;
    width: 100%;"> -->
<div class = "roww contentt" style = "
    width: 100%; height:0%">
                <div class = "boxx" style="text-align: center; width: 20%; height:100%; float: left; background-color: rgb(160, 160, 160)">
                  
                    <div style = "width: 100%; height:30px;">
                      <form action = GET>
                        <input onclick = "disable();load_new_plot();" type = "radio" id="national" name = "location" value = "national" checked = "checked">
                        <label for="national">National</label>
                        <input onclick = "undisable();load_new_plot();" type = "radio" id="hospital" name = "location" value = "hospital">
                        <label for = "hospital">Hospital</label>
                        <!-- <a class="active" href="#home">National</a>
                        <a href="#news">Hospital</a> -->
                        <script>
                          function disable() {
                          document.getElementById("ha").disabled = true;
                        }

                          function undisable() {
                          document.getElementById("ha").disabled = false;
                        }
                        </script>

                      </form>
                    </div>
                    <div style = "width: 100%; height: 30px;">
                      <select id = "ha" onchange = 'load_new_plot()' style = "width:100%; height: 100%; margin: 4px 0px;" disabled>
                      <option value="" disabled selected hidden>Choose a hospital...</option>
                      <?php
                          if(!$orgs = mysqli_query($conn, "SELECT `ha_id`, `ha_name` FROM `health_authority`")) {
                            echo "Failed to query database for category options!";
                        }
                        else {
                          while($row = mysqli_fetch_assoc($orgs)) {
                            $orgid = $row["ha_id"];
                            $orgname = $row["ha_name"];
                            echo "<option style = \"width:100%\"; value='$orgid'>$orgname</option>"; 
                        }
                          }
                        ?>
                      </select>
                    </div>
                    <div style = "height: 30px; width: 100%; margin: 4px 0px;">
                      <form>
                        <input type="text" id="vac_query" name="vac_query" placeholder = "Vaccine / Lot nr." style = "width: 85%; float:left">
                        <label for="vac_query"></label>
                        <input type = "submit" style = "width:15%; float: right" value = "Go">
                      </form>
                    </div>
                    <div class = "row content" style="direction: rtl; height:100%; scrollbar-gutter: stable; overflow:auto; ">
                      <div style = " width: 100%; direction: ltr; margin: 0px 10px;">
                        
                          <?php
                          include "select_vaccines.php";
                          ?>
                        
                      </div>
                    </div>
                  
                </div>
                <div style="width: 80%; height: 100%; float: right; background-color:rgba(158, 232, 245, 0.92);">
                  <!-- <div class="topnav" style="width: 20%; float: right; background-color:azure;">
                    <a class="active" href="#home">National</a>
                    <a href="#news">Hospital</a>
                  </div> -->
                    <div id="plot"  style="width: 100%; height: 100%;">
                    <?php
                    include "gen_plot.php";
                    ?>

                    </div>
                </div>
                  

</div>
<!-- Footer on bottom of page -->
<div class = "roww footerr">
  Shuai was here :]
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
</div>
</div>

</div>
</body>


</html>
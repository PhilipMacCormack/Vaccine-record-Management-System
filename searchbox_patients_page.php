<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<head>
  <title>Search results</title>
</head>

<!-- Top navigation bar -->
<body>
    <div class="w3-bar w3-black w3-hide-small">
      <a href="/Catwoman-IMS/healthcareworkerhome.php" class="w3-bar-item w3-button w3-left">&emsp;Home&emsp;</a>
      <a href="/Catwoman-IMS/registervaccine.php" class = "w3-bar-item w3-button w3-left">Register vaccine</a>
      <a href="/Catwoman-IMS/worker_patients_page.php" class = "w3-bar-item w3-button w3-left">Patients</a> 
      <a href="/Catwoman-IMS/statisticspage.php" class = "w3-bar-item w3-button w3-left">Statistics</a> 
      <a href="#search" class="w3-bar-item w3-button w3-right"><i class="fa fa-search"></i></a>
      <a href="/Catwoman-IMS/index.html" class = "w3-bar-item w3-button w3-right">Log out</a> 
      <a href="/Catwoman-IMS/workerprofilepage.html" class = "w3-bar-item w3-button w3-right">Profile</a> 
    </div>

<!-- UniVaP logo -->
<div class="container">
    <header class="w3-container w3-padding-8 w3-center w3-black" id="home">
        <h1 class="w3-jumbo"><span class="w3-hide-small"></span> UniVaP</h1>
        <p><b>Uniform Vaccination Platform</b></p>
    </header>

<!-- Design for search result page -->
<div class = "block">
<br><h2><b>&emsp;All Patients: Search Results</b></h2>
<table class="styled-table">
            <thead>
                <tr>
                    <th>Personal Number</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>DOB</th>
                </tr>
            </thead>
                            <tbody>
                            
                                <?php 
                                    require "db.php";
                                    //If you search for something go into if statement
                                    if(isset($_GET['search']))
                                    {
                                        // Create a variable for the search input
                                        $filtervalues = $_GET['search'];

                                        //Query everything in the table where anything matches the search input (could change to only mname in concat)
                                        $query = "SELECT * FROM patient WHERE CONCAT(p_number, p_first_name, p_last_name) LIKE '%$filtervalues%'";
                                        $query_run = mysqli_query($conn, $query);

                                        //If the query get any results, print the results in a table, else print No Records Found
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                    <?php
                                                        echo "<tr><td>";
                                                        $pID = $items['p_number'];
                                                        echo $items['p_number'];
                                                        echo "</td><td>";
                                                        echo $items['p_first_name']." ".$items['p_last_name'];
                                                        echo "</td><td>";
                                                        echo $items['p_email'];
                                                        echo "</td><td>";
                                                        echo $items['p_phonenr'];
                                                        echo "</td><td>";
                                                        echo $items['p_adress'].", ".$items['p_postcode']." ".$items['p_city'];
                                                        echo "</td><td>";
                                                        echo $items['AGE'];
                                                        echo "</td><td>";
                                                        echo $items['dob'];
                                                        echo "</td></tr>";
                                                        echo "<tr>";
                                                        echo "<td colspan=\"7\"><div><table class = \"nested-table\"><tr>";
                                                        echo "<td>Vaccine</td><td>Batch</td><td>Nplid</td><td>Dose</td><td>Date</td></tr>";
                                                        if(!$reports=mysqli_query($conn, "SELECT * FROM `report` WHERE '$pID' = `p_number`")) {
                                                            echo "Failed to query reports!";
                                                        }
                                                        else {
                                                            while ($line = mysqli_fetch_row($reports)){
                                                                echo "<tr><td>";
                                                                echo $line[7];
                                                                echo "</td><td>";
                                                                echo $line[6];
                                                                echo "</td><td>";
                                                                echo $line[5];
                                                                echo "</td><td>";
                                                                echo $line[1];
                                                                echo "</td><td>";
                                                                echo $line[3];
                                                                echo "</td></tr>";
                                                            }
                                                        }
                                                        echo "</tr></table></div></td>"; 
                                                        echo "</tr>";
                                                    ?>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No records found for: <?php echo $filtervalues?></td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <script>
                        $(function() {
                            $("td[colspan=7]").find("div").hide();
                            $("tr").click(function(event) {
                                var $target = $(event.target);
                                $target.closest("tr").next().find("div").slideToggle();                
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer on bottom of page -->
<div class="footer">
    <a href="/Catwoman-IMS/privacy.html">Privacy</a>
    /
    <a href="/Catwoman-IMS/terms_conditions.html">Terms & Conditions</a>
  </div>

</body>
</html>
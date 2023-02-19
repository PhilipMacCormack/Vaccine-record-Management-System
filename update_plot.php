<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
            // const checkbox = document.querySelector('#checkbox');
            // checkbox_label.addEventListener('click', function(e){
            // alert('The checkbox was clicked!');
            // e.stopPropagation();

            //  })
            

            function load_new_content(){
                var selected_option_value=$("#ha option:selected").val();
                var national=$('input[name="location"]:checked').val();
                var vaccine = $('input[name="vaccine"]:checked').val();
                $.post("values.php", {dropdown_value: selected_option_value, radio_value:national, vaccine_value:vaccine},
                function(data){
                    $("#div").html(data);
                })
            };

            // $(function() {
            //     var rows = $('tr').not(':first');
            //     rows.on('click', function(e) {
            //         var row = $(this);
            //         row.toggleClass('highlight');
            //     })
            // });
            
            $(function() {
                $("td[colspan=2]").find("div").hide();
                $("tr").click(function(event) {
                    var $target = $(event.target);
                    $target.closest("tr").next().find("div").slideToggle();   
                    document.write('row clicked');             
                });
            });

            $('input:checkbox').on('click', function(e){
            e.stopPropagation();
            console.log('button clicked');
            });         

            // function toggleArrayItem(a, v) {
            //     var i = a.indexOf(v);
            //     if (i === -1)
            //         a.push(v);
            //     else
            //         a.splice(i,1);
            // }


            
        </script>
        <?php
        include "db.php";
        ?>

            <style>
                tr { cursor: default; }
                .highlight { background: red; }
            </style>
    </head>
        <input onclick = 'load_new_content()' type = "radio" id="national" name = "location" value = "national" checked = "checked">
        <label for="national">National</label>
        <input  onclick = 'load_new_content()' type = "radio" id="hospital" name = "location" value = "hospital">
        <label for="national">Hospital</label>

        <select id = "ha" onchange='load_new_content()'>
        <!-- <option value="" disabled selected hidden>Choose a hospital...</option> -->
        <?php
            if(!$orgs = mysqli_query($conn, "SELECT `ha_id`, `ha_name` FROM `health_authority`")) {
            echo "Failed to query database for health authorities!";
        }
        else {
            while($row = mysqli_fetch_assoc($orgs)) {
            $orgid = $row["ha_id"];
            $orgname = $row["ha_name"];
            echo "<option value='$orgid'>$orgname</option>"; 
        }
            }
        ?>
        </select>
        <table>
            <tr>
                <td>
                    Vaccine1
                </td>
                <td>
                    <input type = 'checkbox' value = 'vaccine1' name = 'vaccine'>
                </td>
            </tr>
            <tr>
                <td colspan ="2">
                    <div>
                    <table>
                        <tr>
                            <td>
                            Batch1
                            </td>
                            <td>
                                <input type = 'checkbox' value = 'vaccine1' name = 'vaccine'>
                            </td>
                        </tr>
                    </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                Vaccine2
                </td>
                <td>
                <input type = 'checkbox' value = 'vaccine1' name = 'vaccine'>
                </td>
            </tr>
            <tr>
                <td colspan ="2">
                    <div>
                    <table>
                        <tr>
                            <td>
                            Batch1
                            </td>
                            <td>
                                <input type = 'checkbox' value = 'vaccine1' name = 'vaccine'>
                            </td>
                        </tr>
                    </table>
                    </div>
                </td>
            </tr>
        </table>
    <div id = "div">

    </div>



</html>
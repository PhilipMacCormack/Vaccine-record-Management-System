<html>
    <?php
    include "db.php";
        if(!$vacs = mysqli_query($conn, "SELECT DISTINCT `v_name` FROM `vaccine`")) {
            echo "Failed to query database for category options!";
        }
        else {
            echo "<table style = 'width:100%'>";
        while($row = mysqli_fetch_assoc($vacs)) {
            $vac = $row["v_name"];
            if(!$bats = mysqli_query($conn, "SELECT DISTINCT `batch_no` FROM `vaccine` WHERE `v_name` = '$vac'")) {
                echo "Failed to query database for category options!";
            }
            else {
                
                echo "<tr><td style = \"text-align:left;font-weight:600;\">".$vac."</td><td style = \"text-align:right;\"><input type=\"checkbox\" onclick = 'load_new_plot()' value =\"$vac:*\" name = \"vaccine[]\"></td></tr><tr><td colspan=\"2\"><div>";
                echo "<table style = \"text-align:right; width:100%;\">";
                echo "<tr><td style = \"text-align:left;\">BATCHES</td><td style = \"text-align:center;vertical-align: middle;\"><input type=\"checkbox\" name = 'check_all'></td></tr>";
            while($row = mysqli_fetch_assoc($bats)) {
                $bat = $row["batch_no"];
                echo "<tr><td style = \"text-align:left;\">$bat</td><td style = \"text-align:center;vertical-align: middle;\"><input type=\"checkbox\" onclick = 'load_new_plot()' value =\"$vac:$bat\" name = \"vaccine[]\"></td></tr>";
            }
                echo "</table><div></td>";
            }
        }
            echo "</table>";
        }
    ?>
    <script>
$(function() {
    $("td[colspan=2]").find("div").hide();
    $("tr").click(function(event) {
        var $target = $(event.target);
        $target.closest("tr").next().find("div").slideToggle();                
    });
});
$('input:checkbox').on('click', function(e){
            e.stopPropagation();
            console.log('button clicked');
            });
$('input:checkbox[name = "check_all"]').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    load_new_plot();
});


</script>
</html>
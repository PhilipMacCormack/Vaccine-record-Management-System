function select_Report(){


    var x = document.getElementById("report_id").value;
    $.ajax({
        url:"show_report.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
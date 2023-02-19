function select_Notification(){

    var x = document.getElementById("report_id").value;

    $.ajax({
        url:"show_notification.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
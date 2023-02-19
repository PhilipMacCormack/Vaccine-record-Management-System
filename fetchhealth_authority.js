function selectHealth_authority(){
    
    var x = document.getElementById("health_authority").value;

    $.ajax({
        url:"show_health_authority.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
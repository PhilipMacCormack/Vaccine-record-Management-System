function selectUser(){
    
    var x = document.getElementById("unactivated_user").value;

    $.ajax({
        url:"showunactivated_user.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
function selectP_login(){
    
    var x = document.getElementById("patient").value;

    $.ajax({
        url:"showp_login.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
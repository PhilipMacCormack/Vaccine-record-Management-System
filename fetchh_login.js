function selectH_login(){

    var x = document.getElementById("h_login").value;

    $.ajax({
        url:"show_h_login.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
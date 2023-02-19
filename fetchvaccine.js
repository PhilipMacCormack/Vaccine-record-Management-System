function selectVaccine(){
    
    var x = document.getElementById("vaccine").value;

    $.ajax({
        url:"showvaccine.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
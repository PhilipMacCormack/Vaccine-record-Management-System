function selectPatient(){
    
    var x = document.getElementById("patient").value;

    $.ajax({
        url:"showpatient.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
function selectHealthcare_worker(){
    
    var x = document.getElementById("healthcare_worker").value;

    $.ajax({
        url:"show_healthcare_worker.php",
        method: "POST",
        data: {
            id : x
        },
        success: function(data){
            $("#ans").html(data);
        }
    })

}
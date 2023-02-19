<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./style.css">
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<table class = "styled-table">
    <thead>
        <tr>
            <th>one</th><th>two</th><th>three</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><p>data<p></td><td>data</td><td>data</td>
        </tr>
        <tr>
            <td colspan="3">
                <div>
                    <table class = "nested-table">
                            <tr>
                                <th>data</th><th>data</th>
                            </tr>
                    </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<script>
$(function() {
    $("td[colspan=3]").find("div").hide();
    $("tr").click(function(event) {
        var $target = $(event.target);
        $target.closest("tr").next().find("div").slideToggle();                
    });
});
</script>

</html>

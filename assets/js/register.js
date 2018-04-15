$(document).ready(function () {
   // On click signup, hide login and show regitration
    $("#signup").click(function () {
       $("#first").slideUp("slow", function () {
           $("#second").slideDown("slow");
       }) 
    });

    // On click signup, hide registration and show login form
    $("#signin").click(function () {
        $("#second").slideUp("slow", function () {
            $("#first").slideDown("slow");
        });
    });
});

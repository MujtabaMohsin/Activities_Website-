$(document).ready(function(){

    $("#registerWindowBtn").click(function(){

        $("#loginForm").fadeOut(50);
        $("#registerForm").fadeIn(500);

    })

    $("#loginWindowBtn").click(function(){

        $("#registerForm").fadeOut(50);
        $("#loginForm").fadeIn(500);

    })


    $(function() {
        // Sidebar toggle behavior
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
        });
    });


    $("#searchBox").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".activityCard .card-title").filter(function() {
            var currentElement = $(this).attr("id");
            $("#activityCard"+currentElement).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
});



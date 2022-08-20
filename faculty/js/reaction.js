$(document).ready(function () {
    $(".emoji").on("click", function () {
        // Here we are getting the reaction which is tapped by using the data-reaction attribute defined in main page
        var data_reaction = $(this).attr("data-reaction");
        // Sending Ajax request in handler page to perform the database operations
        $.ajax({
            type: "POST",
            url: "php/like.php",
            data: "data_reaction=" + data_reaction,
            success: function (response) {
                // This code will run after the Ajax is successful
                $(".like-details").html("You, Knowband and 10k others");
                $(".reaction-btn-emo").removeClass().addClass('reaction-btn-emo').addClass('like-btn-' + data_reaction.toLowerCase());
                $(".reaction-btn-text").text(data_reaction).removeClass().addClass('reaction-btn-text').addClass('reaction-btn-text-' + data_reaction.toLowerCase()).addClass("active");

                if (data_reaction == "Like")
                    $(".like-emo").html('<span class="like-btn-like"></span>');
                else
                    $(".like-emo").html('<span class="like-btn-like"></span><span class="like-btn-' + data_reaction.toLowerCase() + '"></span>');
            }
        })
    });

    $(".reaction-btn-text").on("click", function () { // undo like click
        if ($(this).hasClass("active")) {
            // Sending Ajax request in handler page to perform the database operations
            $.ajax({
                type: "POST",
                url: "php/undo_like.php",
                data: "",
                success: function (response) {
                    // Handle when the Ajax is successful
                    $(".reaction-btn-text").text("Like").removeClass().addClass('reaction-btn-text');
                    $(".reaction-btn-emo").removeClass().addClass('reaction-btn-emo').addClass("like-btn-default");
                    $(".like-emo").html('<span class="like-btn-like"></span>');
                    $(".like-details").html("Knowband and 1k others");
                }
            })
        }
    })
});
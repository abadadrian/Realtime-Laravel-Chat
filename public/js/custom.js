var url = "http://chatinity.local";
window.addEventListener("load", function () {
    // Scroll to the top to see new updates(images)
    // Set a timeout...
    setTimeout(function () {
        // Hide the address bar!
        window.scrollTo(0, 1);
    }, 0);

    // Like button
    function like() {
        $(".btn-like")
            .unbind("click")
            .click(function () {
                console.log("like");
                $(this).addClass("btn-dislike").removeClass("btn-like");
                $(this).attr("src", url + "/material/img/like-red.svg");
                // Get element which class is like-count
                var likeCount = $(this).parent().find(".like-count");
                console.log(likeCount);
                // Get the number from like-count and increment with 1
                var count = parseInt(likeCount.text()) + 1 + " Likes";
                // Show the number in like-count
                likeCount.text(count);

                // Ajax request
                $.ajax({
                    // Get like icon data-id
                    url: url + "/like/" + $(this).data("id"),
                    type: "GET",
                    success: function (response) {
                        // Check if the user has already liked the image
                        if (response.like) {
                            console.log("You liked this image");
                        } else {
                            console.log("Error while like this image");
                        }
                    },
                });
                dislike();
            });
    }
    like();

    // Dislike button
    function dislike() {
        $(".btn-dislike")
            .unbind("click")
            .click(function () {
                console.log("dislike");
                $(this).addClass("btn-like").removeClass("btn-dislike");
                $(this).attr("src", url + "/material/img/like-outline.svg");
                // Get element which class is like-count
                var likeCount = $(this).parent().find(".like-count");
                // Get the number from like-count and decrement with 1
                var count = parseInt(likeCount.text()) - 1 + " Likes";
                // Show the number in like-count
                likeCount.text(count);

                $.ajax({
                    // Get dislike icon data-id
                    url: url + "/dislike/" + $(this).data("id"),
                    type: "GET",
                    success: function (response) {
                        // Check if the user has already disliked the image
                        if (response.like) {
                            console.log("You disliked this image");
                        } else {
                            console.log("Error while dislike this image");
                        }
                    },
                });
                like();
            });
    }
    dislike();

    // Users search
    $("#search").submit(function (e) {
        $(this).attr(
            "action",
            url + "/people/" + $("#search #search-input").val()
        );
    });

    //Input Custom
        $("#upload_link").on('click', function(e){
            e.preventDefault();
            $("#image_path:hidden").trigger('click');
        });


});

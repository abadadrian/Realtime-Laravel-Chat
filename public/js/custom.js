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

    // // Media query 576px
    // if (window.matchMedia("(max-width: 576px)").matches) {
    //     // Get element button with id send
    //     var btn = document.getElementById("send");
    //     // Remove content from .btn
    //     console.log(btn);
    //     btn.empty();
    //     console.log(btn);
    //     // Add content to .btn
    //     btn.append(
    //         '<svg aria-label="Direct" class="_8-yf5 " color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24"><line fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2" x1="22" x2="9.218" y1="3" y2="10.083"></line><polygon fill="none" points="11.698 20.334 22 3.001 2 3.001 9.218 10.084 11.698 20.334" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></polygon></svg>'
    //     );
    //     console.log(btn);

    // }

});

$(document).ready(function () {
    
    $(".up").click(function(){
        let post = $(this).closest('form').attr('id');
        let idPost = post.replace('post', '');
        let objPost = {"post": idPost};
        let postJSON = JSON.stringify(objPost);
        $.ajax({
            type: "POST",
            url: "inc/funcphp.php",
            data: {postupvote: postJSON},
            cache: false,
            success: function (data) {
                let objReturn = JSON.parse(data);
                switch (objReturn.resultado) {
                    case "1":
                        $('#' + post).children(".up").addClass("clicked");
                        break;
                    case "2":
                        $('#' + post).children(".down").removeClass("clicked");
                        $('#' + post).children(".up").addClass("clicked");
                        break;
                    case "3":
                        $('#' + post).children(".up").removeClass("clicked");
                        break;
                    default:
                        break;
                }
            }
        });
    });

    $(".down").click(function () {
        let post = $(this).closest('form').attr('id');
        let idPost = post.replace('post', '');
        let objPost = { "post": idPost};
        let postJSON = JSON.stringify(objPost);

        $.ajax({
            type: "POST",
            url: "inc/funcphp.php",
            data: { postdownvote: postJSON },
            cache: false,
            success: function (data) {
                let objReturn = JSON.parse(data);
                switch (objReturn.resultado) {
                    case "1":
                        $('#' + post).children(".down").addClass("clicked");
                        break;
                    case "2":
                        $('#' + post).children(".up").removeClass("clicked");
                        $('#' + post).children(".down").addClass("clicked");
                        break;
                    case "3":
                        $('#' + post).children(".down").removeClass("clicked");
                        break;
                    default:
                        break;
                }
            }
        });
    });

});
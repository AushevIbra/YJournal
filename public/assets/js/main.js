$(function () {

    $("[data-id='login']").on('click', function () {
        $(".popup-login").addClass('active');
        $(".popup-login").attr('data-active', 'true');
    })

    $('[data-active]').on('click', function(){
       $(".popup-login").removeClass('active');
        $(".popup-login").attr('data-active', 'false');
    });
    $('.form-add-comment').on('submit', function (e) {
        e.preventDefault();
        const url = e.target.getAttribute('action');
        const _token = $(".form-add-comment > input[name='_token']").val();
        const text = $(".form-add-comment  textarea[name='text']").val();
        const postsId = $('.form-add-comment > input[name="posts_id"]').val();
        const files = window.files || null;

        $.post(url, {text, files, _token, posts_id: postsId})
            .done(function (data) {
                $(".form-add-comment  textarea[name='text']").val(null);

            })
            .fail(data => {
                const response = data.responseJSON.errors;

                Object.keys(response).map(key => {
                    response[key].map(msg => {
                        M.toast({html: msg, classes: 'rounded'})
                    })
                })


            })
    })

    $(".reply-comment").on('click', function () {
        window.parentID = this.getAttribute('data-id');
        window.userID = this.getAttribute('data-user-reply-id');
        window.userName = this.getAttribute('data-name')
    })

    ion.sound({
        sounds: [


            {
                name: "button_tiny",
                volume: 0.3,
                preload: true
            }
        ],
        volume: 0.5,
        path: "/ion/sounds/",
        preload: true
    });

})



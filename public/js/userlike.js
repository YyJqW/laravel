function urlsend(id)
{
    $(document).ready(function ()
    {
        let liked = false;
        $.ajax({
            url: "/liked/"+id,
            dataType: 'json',
            success: function (data) {
                let button = $("#button"+id);
                liked = data.data
                console.log(data);
                if (liked) {
                    $.ajax({url:'unlike/'+id})
                    button.removeClass();
                    button.addClass("bi bi-hand-thumbs-up")
                } else {
                    $.ajax({url:'like/'+id})
                    button.removeClass();
                    button.addClass("bi bi-hand-thumbs-up-fill")
                }
            },
            error: function (error) {

            }
        })
    });
}

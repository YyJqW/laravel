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
                let badge = $("#badge"+id);
                let count;
                liked = data.data
                if (liked) {
                    $.ajax({
                        url:'/unlike/'+id,
                        success:function ()
                        {
                            button.removeClass();
                            button.addClass("bi bi-hand-thumbs-up")
                            $.ajax({
                                url:'/like/count/status/'+id,
                                type:'get',
                                success:function (data)
                                {
                                    count=data.count;
                                    if(count==0)
                                    {
                                        badge.remove();
                                    }
                                    else
                                    {
                                        badge.text(count);
                                    }
                                },
                                error:function (error)
                                {
                                    console.log(error);
                                }
                            });
                        }
                    })
                } else {
                    $.ajax({
                        url:'/like/'+id,
                        success:function ()
                        {
                            button.removeClass();
                            button.addClass("bi bi-hand-thumbs-up-fill")
                            $.ajax({
                                url:'/like/count/status/'+id,
                                type:'get',
                                success:function (data)
                                {
                                    count=data.count;
                                    if(badge[0]===undefined)
                                    {
                                        button.parent().append(
                                            "<span\n" +
                                            "class=\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-light\"\n" +
                                            "id=\"badge"+id+"\">\n" +
                                            "</span>");
                                        badge=$("#badge"+id);
                                    }
                                    badge.text(count);
                                },
                                error:function (error)
                                {
                                    console.log(error);
                                }
                            });
                        }
                    })
                }
            },
            error: function (error) {
                console.log(error)
            }
        })
    });
}
function urlsend_comment(id)
{
    $(document).ready(function ()
    {
        let liked = false;
        $.ajax({
            url: "/liked_comment/"+id,
            dataType: 'json',
            success: function (data) {
                let button = $("#button_comment"+id);
                let badge = $("#commentBadge"+id)
                let count;
                liked = data.data
                console.log(data);
                if (liked) {
                    $.ajax({
                        url:'/unlike_comment/'+id,
                        success:function (){
                            button.removeClass();
                            button.addClass("bi bi-hand-thumbs-up")
                            $.ajax({
                                url:'/like/count/comment/'+id,
                                type:'get',
                                success:function (data)
                                {
                                    count=data.count;
                                    if(count==0)
                                    {
                                        badge.remove();
                                    }
                                    else
                                    {
                                        badge.text(count);
                                    }
                                },
                                error:function (error)
                                {
                                    console.log(error);
                                }
                            })
                        }
                    })
                } else {
                    $.ajax({
                        url:'/like_comment/'+id,
                        success:function ()
                        {
                            button.removeClass();
                            button.addClass("bi bi-hand-thumbs-up-fill")
                            $.ajax({
                                url:'/like/count/comment/'+id,
                                type:'get',
                                success:function (data)
                                {
                                    count=data.count;
                                    if(badge[0]===undefined)
                                    {
                                        console.log(button.parent());
                                        button.parent().append(
                                            "<span\n" +
                                            "class=\"position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary text-light\"\n" +
                                            "id=\"commentBadge"+id+"\">\n" +
                                            "</span>");
                                        badge=$("#commentBadge"+id);
                                    }
                                    badge.text(count);
                                },
                                error:function (error)
                                {
                                    console.log(error);
                                }
                            });
                        }
                    })
                }
            },
            error: function (error) {
                console.log(error)
            }
        })
    });
}

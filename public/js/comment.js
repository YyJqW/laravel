function addComment(id,user)
{

    let parent;
    let comment_id;
    parent=0;
    $("#commentSubmit").click(function ()
    {
        let comment=$("#comment");
        let data=comment.val();
        $.ajax({
            url:'/comment/'+id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{'comment':data,'status_id':id,'parent':parent},
            type:'post',
            success:function (){
                $.ajax({
                    url:'/comment/count/'+id,
                    dataType: 'json',
                    success:function (_data){
                        comment_id=_data.count
                        $("#commentCard").append("<div class='card-body text-right border' style='font-size: 20px'><p>"
                            +data+
                            "</p>"+
                            "<p>"+
                            user
                            +"</p>"+
                            "<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">"+
                            "<button class=\"btn btn-light\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapse"+comment_id+"\" aria-expanded=\"false\" aria-controls=\""+comment_id+"\">"+
                            "评论"+
                            "</button>"+
                            "<button class='btn btn-light position-relative' onClick='urlsend_comment("+comment_id+")'>"+
                            "<i id='button_comment"+comment_id+"' class='bi bi-hand-thumbs-up'></i>"+
                            "</button>"+
                            "</div>"+
                            "<div class=\"collapse\" id=\"collapse"+comment_id+"\">\n" +
                            "                    <div class=\"card card-body\" id=\"sonCommentCard"+comment_id+"\">\n" +
                            "<textarea class=\"form-control\" id=\"sonComment"+comment_id+"\"></textarea>\n" +
                            "                        <div>\n" +
                            "<script>addSonComment("+comment_id+","+"\""+user+"\""+")</script>"+
                            "                            <button class=\"btn btn-light\" id=\"sonCommentSubmit"+comment_id+"\">回复</button>\n" +
                            "                        </div>"+
                            "                    </div>\n" +
                            "                </div>");
                        console.log(data);
                    },
                    error:function (error)
                    {
                        console.log(error);
                    }
                });
            },
            error:function (error)
            {
                console.log(error);
            }
        });
        comment.val('');
    });

}

function addSonComment(id,user)
{
    // let father=$("#static");
    // father.delegate("#sonCommentSubmit"+id,"click",function (){
    //
    // })
    $("#sonCommentSubmit"+id).click(function ()
    {
        let comment=$("#sonComment"+id);
        let data=comment.val();
        $.ajax({
            url: '/comment/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'comment': data, 'status_id': 0, 'parent': id},
            type: 'post',
            success:function (_data)
            {
                let commentCard=$("#sonComment"+id);
                comment.val("");
                console.log(commentCard);
                commentCard.before(
                    "<div class=\"card-body border\">\n" +
                    "                                    <p>\n" +
                    user+
                    ":"+
                    data+
                    "                                        <button class=\"btn btn-light\" id=\"sonCommentSubmit{{$son->id}}\"\n" +
                    "                                                onclick=\"$('#sonComment"+id+"').val('回复 "+user+"：')\">\n" +
                    "                                            回复\n" +
                    "                                        </button>\n" +
                    "                                    </p>\n" +
                    "                                </div>"
                );
            },
            error:function (error)
            {
                console.log(error);
            }
        });
    })

}

function paginationList(url)
{
    $.ajax({
        url:url,
        success:function (data)
        {
            let newpage=$(data)
            let newcomment=$(newpage.find('#static'));
            $("#static").html(newcomment)
        },
        error:function (error)
        {
            console.log(error);
        }
    })
}

function sonPaginationList(url,id)
{
    $.ajax({
        url:url,
        success:function (data)
        {
            let newpage=$(data)
            let newcomment=$(newpage.find("#sonCommentCard"+id));
            $("#sonCommentCard"+id).html(newcomment)
        },
        error:function (error)
        {
            console.log(error);
        }
    })
}

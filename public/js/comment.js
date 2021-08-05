function addComment(id,user)
{
    $(document).ready(function (){
        let comment_id;
        $.ajax({
            url:'/comment/count',
            dataType: 'json',
            success:function (data){
                comment_id=data.count+1
            }
        });
        $("#commentSubmit").click(function ()
        {
            let comment=$("#comment");
            let data=comment.val();
            $.ajax({
                url:'/comment/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{'comment':data,'status_id':id},
                type:'post',
                success:function (){
                    $("#commentCard").append("<div class='card-body text-right border' style='font-size: 20px'><p>"
                        +data+
                        "</p>"+
                        "<p>"+
                        user
                        +"</p>"+
                        "<button class='btn btn-light' onClick='urlsend_comment("+comment_id+")'>"+
                            "<i id='button_comment"+comment_id+"' class='bi bi-hand-thumbs-up'></i>"+
                        "</button>"+
                        "</div>");
                    console.log(data);
                },
                error:function (error)
                {
                    console.log(error);
                }
            });
            comment.val('');
        });
    })

}

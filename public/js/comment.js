function addComment(id,user)
{
    $(document).ready(function (){
        $("#commentSubmit").click(function ()
        {
            let comment=$("#comment");
            let data=comment.val();
            $.ajax({
                url:'comment/'+id,
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

function addComment(id)
{
    $(document).ready(function (){
        $("#commentSubmit").click(function ()
        {
            let data=$("#comment").val();
            $.ajax({
                url:'comment/'+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{'comment':data},
                type:'post',
                success:function (){
                    console.log(data);
                },
                error:function (error)
                {
                    console.log(error);
                }
            });
        });
    })

}


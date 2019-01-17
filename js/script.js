$(document).ready(function () {
    $(".jaime").click(function (e) {
        e.preventDefault();
        var postid = $(this).attr('id');
     
        $.ajax({
            url: 'aime.php',
            type: 'post',
            async: false,
            data: {
                'postid':postid,
               
            },
            success:function(data){

                if(data == "vous avez déja voté"){
                    alert(data);
                }else{
                    data = JSON.parse(data);
                    $("#vote"+data['id']).html("J'aime ("+ data['jaime'] +")");
                }
                // jaime.html("J'aime("+(parseInt(jaime.attr("data-value"))+1)+")");
               // jaime.attr("data-value",(parseInt(jaime.attr("data-value"))+1));
            }
        });
    });
})
$(document).ready(function(){
        $('.trash').on('click',function(){
            var del_id= $(this).attr('id');
            var $ele = $(this).parent().parent().parent().parent();
            if(confirm("Weet u zeker dat u deze wilt verwijderen?")){
            $.ajax({
                type:'POST',
                url:'delete.php',
                data:{'del_id':del_id},
                success: function(data){
                    if(data=="YES"){
                        $ele.fadeOut().remove();
                        }else{
                            alert("can't delete the row")
                        }
                    }
                });
            } else{
               console.log("nope");
            }

            // $.ajax({
            //     type:'POST',
            //     url:'delete.php',
            //     data:{'del_id':del_id},
            //     success: function(data){
            //         if(data=="YES"){
            //             $ele.fadeOut().remove();
            //             }else{
            //                 alert("can't delete the row")
            //             }
            //         }
            //     })
            // })
    });
});
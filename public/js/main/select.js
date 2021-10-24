$(document).ready(function(){
    $(document).on('change','.program',function(){
        var selectOption = $(this).val();
        var div = $(this).parent();
        var url;
       switch (selectOption){
           case "degree":
               url="/institution/university"
               break;
            case "diploma" :
            case "certificate" :
            case "artisan" :
                                    
                    url="/institutions"
                break;
            default :
            return;

       }

       var checkbox=""
       
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                "name":"name"
            },
            success:function(data){
                console.log("success");
                

                for( var i=0; i<data.length;i++){
                    console.log(data[i].name);
                    
                   checkbox += '<div class="col-md-6"><input type="checkbox" name="universities[]" value="'+data[i].name+'" id="'+data[i].name+'">'+data[i].name+'</div>';
                }
                $(document).find('.checkboxes').html("");
                $(document).find('.checkboxes').append(checkbox);
            },
            error:function (){
                console.log("error");
            }
        });
    });

});
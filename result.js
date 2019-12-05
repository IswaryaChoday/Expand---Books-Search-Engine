$(document).on('click','.save', function(e){

  alert(" Saved");
    var id = e.currentTarget.id;
    $.ajax({
        async:false,
        url:'saveditems.php',
        type: 'get',
        data:{'book_id':id},
        dataType: 'text',
        success: function(data){

            console.log(data);
        }


    });


})

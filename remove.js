$(document).on('click','.remove', function(e){
    e.stopImmediatePropagation();
    alert("Item Removed");
    var id = e.currentTarget.id;
    $.ajax({
        async:false,
        url:'remove.php',
        type: 'get',
        data:{'book_id':id},
        dataType: 'text',
        success: function(data){
             location.reload(true); 
            // console.log(data);
        }
    });
})

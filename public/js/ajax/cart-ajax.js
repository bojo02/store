
$('#save').on('submit',function(e){
    e.preventDefault();

    let id = $('input[name="id[]"]').map(function(){ 
                    return this.value; 
                }).get();
    let quantity = $('input[name="quantity[]"]').map(function(){ 
                    return this.value; 
                }).get();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
});
    $.ajax({
      url: "{{route('updatecartelement')}}",
      type:"POST",
      data:{
       
        id:id,
        quantity:quantity,
      },
      success: function(data) {
        $('div.flash-message').html(data);
    },
      });
    });
  
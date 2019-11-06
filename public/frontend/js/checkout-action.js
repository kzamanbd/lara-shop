$(document).ready(function(){

    $('#division_id').change(function(){
        var division_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/districts/list',
            data:{division_id:division_id},
            success:function(data) {
                $('#district_id').html(data);
            }
        });
    });

    $('#district_id').change(function(){
        var district_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/upazila/list',
            data:{district_id:district_id},
            success:function(data) {
                $('#upazila_id').html(data);
            }
        });
    });

});
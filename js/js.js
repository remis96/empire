$(document).ready(function () {






    $(".usr-submit-btn").hide();
    var $checkboxes = $('#myTable td input[type="checkbox"]');
    var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
    $(".chb-num").html(countCheckedCheckboxes);
    var speed = 500;

    $checkboxes.change(function(){
        countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        if (countCheckedCheckboxes == 0) {
            $(".usr-submit-btn").slideUp(speed);
        } else {
            $(".usr-submit-btn").removeClass("hidden");
            $(".usr-submit-btn").slideDown(speed);
        }
        $('.chb-num').html(countCheckedCheckboxes);
    });



    $('.userinfo-btn').click(function () {

        var userid = $(this).data('id');
        $.ajax({
            url: 'info_dynamic.php',
            type: 'post',
            data: {userid: userid},
            success: function (response) {
                $('.modal-body').html(response);
                $('#empModal').modal('show');
            }
        });


    });




});


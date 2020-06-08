$(document).ready(function () {

    $('#email').blur(function () {
        var error_email = '';
        var email = $('#email').val();
        // var _token = $('input[name="_token"]').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email)) {
            $('#error_email').html('<label class="text-danger">Este correo ya está en uso</label>');
            $('#email').addClass('has-error');
            $('#register').attr('disabled', 'disabled');
        }
        else {
            $.ajax({
                url: "{{ route('check') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: { email: email },
                success: function (result) {
                    if (result == 'unique') {
                        $('#error_email').html('<label class="text-success">Email Available</label>');
                        $('#email').removeClass('has-error');
                        $('#register').attr('disabled', false);
                    }
                    else {
                        $('#error_email').html('<label class="text-danger">Email not Available</label>');
                        $('#email').addClass('has-error');
                        $('#register').attr('disabled', 'disabled');
                    }
                }
            })
        }
    });

});
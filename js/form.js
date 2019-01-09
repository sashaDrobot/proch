$('#feedback').submit(function (event) {
    event.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $('#load').html('<i class="fa fa-circle-o-notch fa-spin"></i> обработка').prop('disabled', true);
        },
        success: function (result) {
            $('#load').html(result).prop('disabled', true);
        },
        error: function () {
            $('#load').html('Ошибка...').prop('disabled', true);
        },
        complete: function () {
            setTimeout(() => {
                $('#load').html('Отправить').prop('disabled', false);
            }, 3000);
            $('#feedback input, #feedback textarea').val("");
        }
    });
});
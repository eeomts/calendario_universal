$(document).ready(function (e) {


    // SUBMIT FORMS PELO ID USANDO AJAX JQUERY 2025
    $(document).on("submit", "#frm-cadastro", function (e) {
        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            dataType: "json",
            success: function (retorno) {

                let toastTime = retorno.time ? retorno.time : 3000;

                Default.message(retorno.message, false, retorno.type, toastTime);

                if ((retorno.type === 'success' || retorno.type === 'warning') && retorno.url) {
                    Default.redirect(retorno.url, toastTime);
                }

                if (retorno.reload === 'reload') {
                    setTimeout(() => location.reload(), toastTime);
                }
            },
            error: function (xhr) {
                console.log("ERRO AJAX:", xhr.responseText);
                Default.message("Erro inesperado ao enviar o formulário.", false, "error", 3000);
            }
        });
    });

})();
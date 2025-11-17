$(document).ready(function (e) {


    // SUBMIT FORMS PELO ID USANDO AJAX JQUERY 2025
    $(document).on("submit", "#frm-cadastro, #frm-login", function (e) {
        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            dataType: "json",
            success: function (retorno) {

                Default.message(retorno.message, retorno.time, retorno.type, retorno.time);

                if ((retorno.type === 'success') && retorno.url) {
                    Default.redirect(retorno.url,3000);
                }

                if (retorno.reload === 'reload') {
                    setTimeout(() => location.reload(), 2000);
                }
            },
            error: function (xhr) {
                console.log("ERRO AJAX:", xhr.responseText);
                Default.message("Erro inesperado ao enviar o formulário.", false, "error", 3000);
            }
        });
    });

})();
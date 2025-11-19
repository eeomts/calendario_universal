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



// File: `assets/js/main.js`  (adicione isto no final do arquivo existente)
//logout via AJ
        // já existe handler para forms; adiciona logout
        $(document).on("click", "#btn-logout", function (e) {
            e.preventDefault();

            if (!confirm('Deseja realmente sair?')) return;

            // monta endpoint seguro removendo barras duplicadas
            var base = (typeof AJAXPATH !== 'undefined') ? AJAXPATH : '';
            base = String(base).replace(/\/+$/, '');
            var url = base + '/ajax/logout.php';

            fetch(url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Accept': 'application/json' }
            }).then(function (res) {
                return res.json();
            }).then(function (json) {
                if (json && json.type === 'success') {
                    // mostra notificação com toastr via Default.message
                    Default.message(json.message || 'Saindo...', json.time || 2000, 'warning');
                    // redireciona para /login usando base
                    Default.redirect(base + '/login', json.time || 2000);
                } else {
                    Default.message((json && json.message) ? json.message : 'Erro ao efetuar logout.', 3000, 'error');
                }
            }).catch(function (err) {
                console.error('Logout error:', err);
                Default.message('Erro na requisição de logout.', 3000, 'error');
            });
        });




})();
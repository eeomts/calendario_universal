$(document).ready(function (e) {


    //SUBMIT FORMS PELO ID USANDO AJAX JQUERY 2025
    $('#frm-cadastro').submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var actionUrl = form.attr('action');
        $.ajax({
            type: "POST", url: actionUrl, data: form.serialize(), // serializes the form's elements.

            success: function (retorno) {
                retorno = $.parseJSON(retorno);
                Default.message(retorno['message'], false, retorno['type']);
                if (retorno['type'] == 'success' || 'warning') {
                    Default.redirect(retorno['url'], 1500);

                }

                if (retorno['reload'] == 'reload') {
                    location.reload(2000);

                }
            }
        });
    });


    //
    // $('#frm-cadastro').each(function () {
    //
    //
    //     $(this).validate({
    //         showErrors: function (errorMap, errorList) {
    //             $.each(this.validElements(), function (index, element) {
    //                 var $element = $(element);
    //
    //             });
    //             $.each(errorList, function (index, error) {
    //                 var $element = $(error.element);
    //
    //             });
    //         }, submitHandler: function (form) {
    //
    //             var btn = $(form).find("button");
    //             //btn.attr("disabled",true);
    //
    //             var action = $(form).attr('action');
    //             var params = $(form).serialize();
    //
    //             var ajax = new Ajax(action);
    //             Default.message('Aguarde, processando...', false, 'info');
    //             ajax.setParams(params);
    //             ajax.setDataType('json');
    //
    //             disable(form);
    //
    //             ajax.setSuccess(function (retorno) {
    //                 btn.attr("disabled", false);
    //                 enable(form);
    //                 Default.message(retorno['message'], false, retorno['type']);
    //                 if (retorno['type'] == 'success' || 'warning') {
    //                     Default.redirect(retorno['url'], 1000);
    //
    //                 }
    //
    //                 if (retorno['reload'] == 'reload') {
    //                     location.reload();
    //
    //                 }
    //             });
    //             ajax.execute();
    //         },
    //     });
    // });




})();
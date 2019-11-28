function alerta(titulo, mensagem, color)
{
    $.alert({
        title: titulo,
        content: mensagem,
        buttons: {
            cancel: {
                text: 'Ok',
                btnClass: color,
                action: function () {
                    //$.alert('Canceled!');
                }
            }
        }
    });
}

function confirmar(titulo, mensagem, color)
{
    $.confirm({
        title: titulo,
        content: mensagem,
        buttons: {
            confirm: {
                text: "Sim",
                btnClass: color,
                action: function () {
                    return true;
                }
            },
            cancel: {
                text: 'Não',
                btnClass: 'btn-danger',
                action: function () {
                    return false;
                }
            }
        }
    });
}
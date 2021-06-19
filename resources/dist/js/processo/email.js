//CADASTRA RECEBIMENTO
function tEmail() {
    $("#form-new-test").validate();
    if ($("#form-new-test").valid()) {
        var str = $('#form-new-test').serialize();
        $.ajax({
            url: diretorio + 'email/testar',
            type: 'POST',
            data: str,
            error: function (data) {
                console.log(data);
            },
            success: function (result) {
                a = result.trim();
                if(a == 'success-reload') {
                    console.log(a);
                    mensagem('success', 'Teste enviado com sucesso! Sua página será recarregada.');
                    setTimeout(() => location.reload(), 2000);
                }else{
                    console.log(result);
                    mensagem('warning', 'Falha ao enviar, item existente ou dados inválidos! Por favor, verifique.');
                }
            }
        });
    } else {
        mensagem('warning', 'Existem campos obrigatórios! Por favor, verifique.');
    }
}
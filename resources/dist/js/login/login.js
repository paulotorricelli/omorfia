//LOGIN
function logar() {

    // CAMPOS OBRIGATÓRIOS
    let $user = document.forms['formLogin']['inputUsuario'].value;
    let $senha = document.forms['formLogin']['inputSenha'].value;
    let str = $('#formLogin').serialize();

    // validando campos, cadastrando e retornando mensagens de alerta e sucesso
    if ($user != "" && $senha != "") {
        $.ajax({
            url: diretorio + 'login/sessao',
            type: 'post',
            data: str,
            error: function(erro) {
                mensagem('danger', 'Erro ao logar, tente novamente! Por favor, verifique.');
            },
            success: function(data) {  
                switch (data.trim()) {
                    case 'campo':
                        mensagem('warning', 'Campos obrigatórios não foram preenchidos! Por favor, verifique.');
                        break;
                    case 'senha':
                        mensagem('warning', 'Usuário e/ou senha inválidos. Por favor, verifique.');
                        break;
                    case 'erro':
                        mensagem('danger', 'Erro ao logar, tente novamente.');
                        break;
                    case 'logado':
                        window.location.href = "/";
                        break;     
                    default:
                        console.log(data);
                        mensagem('danger', 'Falha ao logar. Contate o Administrador do Sistema.');
                        break;
                }
            }
        });
    } else {
        mensagem('warning', 'Campos obrigatórios não foram preenchidos! Por favor, verifique.');
    }
}

//chamar função logar ao clicar enter
$('input').keyup(function(e) {
    if (e.keyCode == 13) {
        logar();
    }
});
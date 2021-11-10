// JS PARA OS GERENCIAMENTOS DE USUÁRIOS, SMTP, FILIAIS, PAISES
$(function () {
    bsCustomFileInput.init();
});

/*

DATE FORMAT

*/
function dateFormat(date) {
    const dateArray = date.substr(0, 10).split("-");
    let newDate = "";
    for (i = 2; i >= 0; i--) {
        newDate += dateArray[i] + "/";
    }
    return newDate.substr(0, 10);
}

/* 

MODAL - SHOW DATA 

*/
function preencherCamposModal(typeItem, dados) {
    switch (typeItem) {
        case "cliente":
            $("#input-id-modal").val(dados.id_cliente);
            $("#input-razao-social-modal").val(dados.razao_social);
            $("#input-nome-fantasia-modal").val(dados.nome_fantasia);
            $("#input-cnpj-modal").val(dados.cnpj);
            $("#input-cep-modal").val(dados.cep);
            $("#input-endereco-modal").val(dados.endereco);
            $("#input-numero-modal").val(dados.numero);
            $("#input-complemento-modal").val(dados.complemento);
            $("#input-bairro-modal").val(dados.bairro);
            $("#input-cidade-modal").val(dados.cidade);
            $("#input-estado-modal").val(dados.estado);
            $("#input-pais-modal").val(dados.pais);
            $("#input-telefone-empresa-modal").val(dados.telefone_empresa);
            $("#input-nome-responsavel-modal").val(dados.nome_responsavel);
            $("#input-email-responsavel-modal").val(dados.email_responsavel);
            $("#input-telefone-responsavel-modal").val(dados.telefone_responsavel);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        case "disciplina":
            $("#input-id-modal").val(dados.id_disciplina);
            $("#input-nome-modal").val(dados.nome);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        case "combo":
            $("#input-id-modal").val(dados.id_combo);
            $("#input-nome-modal").val(dados.nome);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            listarProdutosCombo(dados.id_combo);
            break;
        case "produto":
            $("#input-id-modal").val(dados.id_produto);
            $("#input-nome-modal").text(dados.nome);
            $("#input-descricao-modal").text(dados.descricao);
            $("#input-premissa-modal").text(dados.premissa);
            $("#input-qtd-padrao-modal").val(dados.qtd_padrao);
            $("#input-horas-media-estimada-modal").val(dados.horas_media_estimada);
            $("#input-custo-medio-estimado-modal").val(dados.custo_medio_estimado);
            $("#input-preco-unitario-modal").val(dados.preco_unitario);
            $("#input-disciplina-modal").val(dados.id_disciplina).change();
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            listarInputsProduto(dados.id_produto);
            listarPredecessorasProduto(dados.id_produto);
            break;
        case "usuario":
            $("#input-id-modal").val(dados.id_usuario);
            $("#input-nome-modal").val(dados.nome);
            $("#input-sobrenome-modal").val(dados.sobrenome);
            $("#input-email-modal").val(dados.email);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            listarMenusUsuario(dados.id_usuario);
            break;
        case "email":
            $("#input-id").val(dados.id_servidor_smtp);
            $("#input-server").val(dados.servidor);
            $("#input-port").val(dados.porta);
            $("#input-user-smtp").val(dados.usuario);
            $("#input-pass-smtp").val(dados.senha);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        case "desconto":
            $("#input-cliente-modal").val(dados.razao_social);
            if (dados.porcentagem_desconto == "0.00") {
                $("#input-desconto-valorfixo-modal").attr('checked');
                //$("#input-desconto-porcentagem-modal").removeAttr('checked');
                $("#div-input-desconto-valorfixo-modal").show();
                $("#div-input-desconto-porcentagem-modal").hide();
            } else {
                $("#input-desconto-porcentagem-modal").attr('checked');
                //$("#input-desconto-valorfixo-modal").removeAttr('checked');
                $("#div-input-desconto-valorfixo-modal").hide();
                $("#div-input-desconto-porcentagem-modal").show();
            }
            $("#input-desconto-tipo-valorfixo-modal").val(dados.valor_fixo_desconto);
            $("#input-desconto-tipo-porcentagem-modal").val(dados.porcentagem_desconto);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        default:
            toastr.warning("Falha ao listar os dados no modal.");
    }
}

/* 

GET DATA + OPEN MODAL

*/
function openModal(event) {
    event.preventDefault();

    const idItem = $(this).attr("id");
    const typeItem = $(this).attr("data-id");

    if (!idItem || !typeItem) {
        toastr.warning("Falha ao listar itens, dados necessários inválidos.");
        return false;
    }

    console.log(idItem, typeItem);

    $.ajax({
        url: urlSistema + typeItem + "/listarItem",
        type: "GET",
        data: { id: idItem },
        error: function (error) {
            toastr.error(
                "Ocorreu um erro ao listar o item selecionado, contate o administrador do sistema."
            );
        },
        success: function (result) {
            result = result.trim();
            console.log(result);
            if (result) {
                let dados = JSON.parse(result);
                preencherCamposModal(typeItem, dados);
                $("#modal-" + typeItem).modal("show");
            } else {
                toastr.warning("Falha ao carregar dados.");
            }
        },
    });
}
$(".btn-modal").click(openModal);

//cadastrar dados de gerenciamento no banco
$('.form-cadastrar').submit(function (event) {

    event.preventDefault();
    let form = $(this);

    form.validate();
    if (form.valid()) {
        let post = form.attr('data-id');
        let id = form.attr('id');
        let url = diretorio + post;

        let formulario = document.getElementById(id);
        let dados = new FormData(formulario);

        //pegar tipo
        let array = new Array(...post.split('/'));
        let tipo = array[0];

        //recebe status do novo registo (!id) ou editar registro (id)
        let verificar = $('#input-id').val();
        let status = '';
        verificar == '' || !verificar ? (status = $("#input-active").is(":checked") == true ? 's' : 'n') : (status = ($("#input-active-modal").is(":checked") == true) ? 's' : 'n');

        //acrescentando o status
        dados.append('status', status);
        //console.log(dados, url, tipo);

        $('.btn-submit-register').attr('disabled', true);

        $.ajax({
            url: url,
            type: 'POST',
            data: dados,
            contentType: false,
            processData: false,
            error: function (result) {
                console.log(result);
                mensagem('danger', 'Falha ao registrar. Contate o Adminsitrador do Sistema.');
                $('.btn-submit-register').attr('disabled', false);
            },
            success: function (result) {
                console.log(result);

                switch (result.trim()) {
                    case 'success-reload':
                        //reaload
                        mensagem('success', 'Registrado com sucesso! Sua página será recarregada.');
                        $(".modal").modal("show");
                        setTimeout(() => location.reload(), 2000);
                        break;

                    case 'erro':
                        mensagem('warning', 'Falha ao registrar, item existente ou dados inválidos! Por favor, verifique.');
                        $('.btn-submit-register').attr('disabled', false);
                        break;
                    case 'acesso-usuario': //without reaload - usuario / editar acessos
                        listarDepartamentos();
                        listarAcesso();
                        $('.btn-submit-register').attr('disabled', false);
                        break;
                    default:
                        //without reload / receive a json
                        console.log(result);
                        let dadosJson = JSON.parse(result);

                        form.trigger("reset");
                        atualizarView(tipo, dadosJson);
                        mensagem('success', 'Registrado com sucesso!');
                        $('.btn-submit-register').attr('disabled', false);
                        break;
                }
            }
        });
    }
});

// USUARIO //

//check menus - alterar menus de acesso (add / del)
function acessoMenu() {
    let checkBoxMenu = $(this);
    checkBoxMenu.attr('disabled', true);
    let acao = checkBoxMenu.is(':checked') ? 'add' : 'del';
    let idMenuUsuario = checkBoxMenu.attr('data-id');

    let idMenuFull = checkBoxMenu.attr('id');
    let idMenu = idMenuFull.substring(5, idMenuFull.length);

    let idUsuario = $('#input-id').val();

    if (idMenu && idUsuario) {
        $.ajax({
            url: diretorio + 'usuario/acessoMenu',
            type: 'POST',
            data: { idMenuUsuario, idUsuario, idMenu, acao },
            error: function (result) {
                mensagem('danger', 'Falha ao adicionar/remover menu para o usuário. Contate o Administrador.');
                //console.log(result);
            },
            success: function (result) {
                //console.log(result);
                switch (result) {
                    case 'erro':
                        mensagem('warning', 'Ocorreu uma falha ao adicionar/remover menu. Tente novamente.');
                        break;
                    case 'del':
                        mensagem('danger', 'Menu removido com sucesso!');
                        checkBoxMenu.attr('disabled', false);
                        break;
                    default:
                        checkBoxMenu.attr('data-id', result);
                        mensagem('success', 'Menu adicionado com sucesso!');
                        checkBoxMenu.attr('disabled', false);
                        break;
                }

            }
        });

    }
}

//listar menus
function listarMenu(dados) {
    $('#nome-colaborador').text(dados[0].usuario);

    //menus
    let divPrincipal = $('#div-principal');
    let divGerenciamento = $('#div-gerenciamento');

    //limpando antigos
    let delDiv = divProcesso.find('div');
    delDiv.remove();
    delDiv = divGerenciamento.find('div');
    delDiv.remove();

    //montando checkbox
    let div = [];
    let input = [];
    let label = [];
    $.each(dados, function (i, item) {

        div[i] = $('<div>');
        input[i] = $('<input>');
        label[i] = $('<label>');

        let id = 'menu-' + item.id_menu;

        switch (item.tipo) {
            case 'lateral-principal':
                div[i].addClass('icheck-success');

                input[i].attr('type', 'checkbox').attr('id', id).attr('data-id', item.id_menu_usuario).addClass('acesso-menu');
                item.id_usuario_ad ? input[i].attr('checked', true) : input[i].attr('checked', false);
                label[i].attr('for', id).text(item.nome);

                item.nome == 'Submissão' ? input[i].attr('checked', true).attr('disabled', true).removeClass('acesso-menu').attr('data-id', '').attr('id', '') : '';

                div[i].append(input[i]);
                div[i].append(label[i]);
                divPrincipal.append(div[i]);

                break;

            case 'lateral-gerenciamento':
                div[i].addClass('icheck-danger');
                input[i].attr('type', 'checkbox').attr('id', id).attr('data-id', item.id_menu_usuario).addClass('acesso-menu');
                item.id_usuario_ad ? input[i].attr('checked', true) : input[i].attr('checked', false);
                label[i].attr('for', id).text(item.nome);

                div[i].append(input[i]);
                div[i].append(label[i]);
                divGerenciamento.append(div[i]);

                break;
            default:
                mensagem('danger', 'Falha ao buscar lista de menus de acesso.');
                break;
        }
    });
    $('.acesso-menu').click(acessoMenu);
}

function listarDepartamentos() {
    let selectDepartamento = $('#select-departamento');

    let idUsuario = $('#input-id').val();

    //limpar options
    let optionDel = selectDepartamento.find('option');
    optionDel.remove();

    $.ajax({
        url: diretorio + 'departamento/listarAcesso',
        type: 'POST',
        data: { idUsuario, acao: 'add' },
        error: function (result) {
            //console.log(result);
            mensagem('danger', 'Erro ao listar os grupos de acesso. Contate o Administrador do Sistema.');
        },
        success: function (result) {
            //console.log(result);

            switch (result) {
                case 'erro':
                    $('#add-acesso').attr('disabled', true);
                    $('#select-departamento').attr('disabled', true);
                    break;
                default:
                    let dados = JSON.parse(result);
                    $('#add-acesso').attr('disabled', false);
                    $('#select-departamento').attr('disabled', false);

                    $.each(dados, function (i, item) {
                        let option = $('<option>');
                        option.val(item.id_departamento).text(`${item.departamento} - ${item.filial} - ${item.pais}`);
                        selectDepartamento.append(option);
                    });
                    break;
            }
        }
    });
}


//remover acessos
function remover(event) {
    event.preventDefault();

    let btnRemove = $(this);

    let tr = btnRemove.parent().parent();
    let id = btnRemove.attr('id');
    let table = btnRemove.attr('data-id');

    if (id && table) {

        $.ajax({
            url: diretorio + 'usuario/remover',
            type: 'POST',
            data: { table, id },
            error: function (result) {
                mensagem('danger', 'Ocorreu um erro durante a exclusão do acesso. Contate o Administrador.');
                //console.log(result);
            },
            success: function (result) {
                //console.log(result);
                if (result) {
                    //atualiza lista de departamentos em acessos do usuário
                    if (table == 'departamento_usuario') {
                        listarDepartamentos();
                    }

                    mensagem('success', 'Acesso removido com sucesso.');

                    tr.fadeOut(1000);
                    setTimeout(function () {
                        tr.remove();
                    }, 2000);
                }
            }
        });
    }
}

// GERAL - EDITAR //

//exibir dados para a tela de editar
function exibir(tipo, dados) {
    switch (tipo) {
        case 'cliente':
            $('#input-nome-modal').val(dados.razao_social).toUpperCase();
            $('#input-sigla-modal').val(dados.sigla).toUpperCase();
            dados.status === 's' ? $('#input-active-modal').click() : $('#input-inactive-modal').click();
            break;

        case 'tema':
            $('#input-tema-modal').val(dados.tema);
            dados.status === 's' ? $('#input-active-modal').click() : $('#input-inactive-modal').click();
            break;

        case 'planta':
            $('#input-planta-modal').val(dados.planta);
            dados.status === 's' ? $('#input-active-modal').click() : $('#input-inactive-modal').click();
            break;    

        case 'email':
            $('#input-server').val(dados.servidor);
            $('#input-port').val(dados.porta);
            dados.ssl == 's' ? $('#input-ssl').attr('checked', true) : $('#input-ssl').attr('checked', false);
            $('#input-user-smtp').val(dados.usuario_smpp);
            break;

        case 'departamento':
            $('#departamento-nome').val(dados.nome);
            dados.status === 's' ? $('#input-active-modal').click() : $('#input-inactive-modal').click();
            dados.pergunta_aprovacao === 's' ? $('#pergunta-aprovacao').attr('checked', true) : $('#pergunta-aprovacao').attr('checked', false);
            break;

        case 'usuario':
            listarMenu(dados);
            listarDepartamentos();
            listarAcesso();
            break;
        default:
            break;
    }
}

// GERAL - EDITAR //
//buscar dados para a tela de editar
function listar(tabela, id) {
    $('#input-id').val(id);

    if (id != '' && tabela != '') {
        let url = diretorio + tabela + '/listar';
        $.ajax({
            url: url,
            type: 'POST',
            data: { id },
            error: function (result) {
                //console.log(result);
                mensagem('danger', 'Falha ao exibir dados. Contate o Adminsitrador do Sistema.');
            },
            success: function (result) {
                //console.log(result);
                switch (result) {
                    case 'erro':
                        mensagem('warning', 'Falha ao exibir dados.');
                        break;
                    default:
                        let dados = JSON.parse(result);
                        //console.log(dados);
                        exibir(tabela, dados);
                }
            }
        });
    }
}

// GERAL - ALTERAR STATUS - ativo e inativo
$(".radio-status").click(alterarStatus);

function alterarStatus() {
    let dados = new Array(...$(this).attr('data-id').split('/'));

    let radio = $(this);
    radio.attr('disabled', true);

    let tabela = dados[0];
    let status = dados[1];
    let id = dados[2];

    if (dados && id) {
        $.ajax({
            url: diretorio + tabela + '/status',
            type: 'POST',
            data: { tabela, status, id },
            error: function () {
                mensagem('danger', 'Erro ao alterar status. Contate o Adminsitrador do Sistema.');
                radio.attr('disabled', false);
            },
            success: function (result) {
                result ? mensagem('success', 'Status alterado com sucesso!') : mensagem('warning', 'Falha ao alterar status.');
                radio.attr('disabled', false);
            }
        });
    } else {
        mensagem('warning', 'Falha ao alterar status.');
        radio.attr('disabled', false);
    }
}
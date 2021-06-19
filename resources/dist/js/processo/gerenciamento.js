// JS PARA OS GERENCIAMENTOS DE USUÁRIOS, SMTP, FILIAIS, PAISES
$(function () {
    bsCustomFileInput.init();
});

// GERAL - MODAL //
//abrir modal
$(".btn-modal").click(modalOpen);

function modalOpen() {

    let tabela = $(this).attr('data-id');
    let id = $(this).attr('id');
    let tela = $(this).attr('data-tela');

    if (tela) {
        meudepartamento(tabela, id);
    } else {
        listar(tabela, id);
    }
    $(".modal").modal("show");
}

$('#btn-smpp-visualizar').click(() => $('#lbl-lista-smpp').text($('#btn-smpp-visualizar').text()));
$('#btn-smpp-gestao').click(() => $('#lbl-lista-smpp').text($('#btn-smpp-gestao').text()));
$('#btn-smpp-departamento').click(() => $('#lbl-lista-smpp').text($('#btn-smpp-departamento').text()));
$('#btn-smpp-user').click(() => $('#lbl-lista-smpp').text($('#btn-smpp-user').text()));

// GERAL - CADASTRAR //
//atualizar view quando não é ideal o reaload
function atualizarView(tipo, dados) {

    if (tipo) {
        let option = $('<option>');
        switch (tipo) {
            case 'pais':
                let selectPais = $('#select-pais');

                option = $('<option>');
                option.val(dados.id_pais).text(dados.nome).attr('selected', true);
                selectPais.append(option);

                selectPais.addClass('text-capitalize');
                $('#next-filial').removeClass('disabled').attr('disabled', false);
                break;
            case 'filial':
                let selectFilial = $('#select-filial');

                option = $('<option>');
                option.val(dados.id_filial).text(dados.nome).attr('selected', true);
                selectFilial.append(option);

                selectFilial.addClass('text-capitalize');
                $('#next-departamento').removeClass('disabled');
                break;

            default:
                console.log('default atualizar view');
                break;
        }
    }
}

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
    let divProcesso = $('#div-processo');
    let divIndicador = $('#div-indicador');
    let divGerenciamento = $('#div-gerenciamento');

    //limpando antigos
    let delDiv = divProcesso.find('div');
    delDiv.remove();
    delDiv = divIndicador.find('div');
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
            case 'lateral-smpp':
                div[i].addClass('icheck-success');

                input[i].attr('type', 'checkbox').attr('id', id).attr('data-id', item.id_menu_usuario).addClass('acesso-menu');
                item.id_usuario_ad ? input[i].attr('checked', true) : input[i].attr('checked', false);
                label[i].attr('for', id).text(item.nome);

                item.nome == 'Submissão' ? input[i].attr('checked', true).attr('disabled', true).removeClass('acesso-menu').attr('data-id', '').attr('id', '') : '';

                div[i].append(input[i]);
                div[i].append(label[i]);
                divProcesso.append(div[i]);

                break;

            case 'lateral-indicador':
                div[i].addClass('icheck-info');
                input[i].attr('type', 'checkbox').attr('id', id).attr('data-id', item.id_menu_usuario).addClass('acesso-menu');
                item.id_usuario_ad ? input[i].attr('checked', true) : input[i].attr('checked', false);
                label[i].attr('for', id).text(item.nome);

                div[i].append(input[i]);
                div[i].append(label[i]);
                divIndicador.append(div[i]);

                break;
            case 'lateral-gerenciar':
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

function listarGrupo() {
    let selectGrupo = $('#select-grupo');

    //limpar options
    let optionDel = selectGrupo.find('option');
    optionDel.remove();

    $.ajax({
        url: diretorio + 'usuario/grupo',
        type: 'GET',
        error: function (result) {
            //console.log(result);
            mensagem('danger', 'Erro ao listar os grupos de acesso. Contate o Administrador do Sistema.');
        },
        success: function (result) {
            //console.log(result);
            if (result) {
                let dados = JSON.parse(result);

                $.each(dados, function (i, item) {
                    let option = $('<option>');
                    option.val(item.id_grupo_acesso).text(item.nome);
                    selectGrupo.append(option);
                });
            }
        }
    });
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

//listar acessos na tabela - usuários
function listarAcesso() {
    let idUsuario = $('#input-id').val();

    let table = $('#table-acessos');

    //limpar options
    let trDel = table.find('tbody tr');
    trDel.remove();

    $.ajax({
        url: diretorio + 'departamento/listarAcesso',
        type: 'POST',
        data: { idUsuario, acao: 'listar' },
        error: function (result) {
            //console.log(result);
            mensagem('danger', 'Erro ao listar os grupos de acesso. Contate o Administrador do Sistema.');
        },
        success: function (result) {
            //console.log(result);

            switch (result) {
                case 'erro':
                    let tr = $('<tr>');
                    let td = $("<td colspan='3' class='text-center'>").text('Nenhum acesso cadastrado');

                    tr.append(td);

                    table.append(tr);

                    mensagem('warning', 'Falha ao listar os departamentos de acesso. Verifique se o colaborador possui algum departamento de acesso.');
                    break;
                default:
                    let dados = JSON.parse(result);

                    $.each(dados, function (i, item) {
                        let tr = $('<tr>');
                        let tdGrupo = $('<td>');
                        let tdDepartamento = $('<td>');
                        let tdBotao = $('<td>');

                        let a = $('<a>');
                        a.attr('title', 'Remover acesso').addClass('text-danger').attr('href', '#');
                        a.attr('id', item.id_departamento_usuario).addClass('remover').attr('data-id', 'departamento_usuario');
                        let icon = $('<i>');
                        icon.addClass('fas').addClass('fa-trash-alt');

                        a.append(icon);

                        tdGrupo.text(item.grupo);
                        tdDepartamento.text(`${item.departamento} - ${item.filial} - ${item.pais}`);
                        tdBotao.append(a);

                        tr.append(tdGrupo);
                        tr.append(tdDepartamento);
                        tr.append(tdBotao);

                        table.append(tr);
                    });
                    $('.remover').click(remover);
            }
        }
    });
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
            listarGrupo();
            listarDepartamentos();
            listarAcesso();
            break;

        case 'submissao':
            $('.input-id').val(dados[0].id_submissao);
            $(".input-id-departamento").val(dados[0].id_departamento);
            $('.input-id-departamento-resposta').val($('#select-departamento').val());
            $('#input-cod-smpp-view').val(dados[0].cod_submissao.toUpperCase());
            $('#input-projeto-view').val(dados[0].projeto.toUpperCase());
            $('#input-data-criacao-view').val(dados[0].data_criacao.toUpperCase());
            $('#input-departamento-view').val(dados[0].departamento.toUpperCase());
            $('#input-filial-view').val(dados[0].filial.toUpperCase());
            $('#input-pais-view').val(dados[0].pais.toUpperCase());
            $('#input-emitente-view').val(dados[0].usuario.toUpperCase());
            $('#input-cliente-view').val(dados[0].cliente.toUpperCase());
            $('#input-artigo-view').val(dados[0].artigo.toUpperCase());
            $('#input-solicitacao-view').val(dados[0].solicitacao.toUpperCase());
            $('#input-documento-cliente-view').val(dados[0].documento_cliente.toUpperCase());
            $('#text-modificacao-view').text(dados[0].modificacao.toUpperCase());
            $('#text-justificativa-modificacao-view').text(dados[0].justificativa_modificacao.toUpperCase());
            $('#text-descricao-modificacao-view').text(dados[0].descricao_modificacao.toUpperCase());
            $('#input-priorizacao-view').val(dados[0].priorizacao);
            $('#input-local-mudanca-view').val(dados[0].local_mudanca);
            $('#input-tipo-mudanca-view').val(dados[0].solicitacao.toUpperCase());
            $('#input-plantas-afetadas-view').val(dados[0].plantas_afetadas);
            $('#input-codigos-afetados-view').val(dados[0].codigos_afetados);
            $('#input-clientes-afetados-view').val(dados[0].clientes_afetados);
            $('#input-impacto-custo-produto-view').val(dados[0].impacto_custo_produto);
            $('#input-impacto-custo-ferramental-view').val(dados[0].impacto_custo_ferramental);
            $('#input-impacto-custo-processo_logistico-view').val(dados[0].impacto_custo_processo_logistico);
            $('#input-impacto-custo-validacao-view').val(dados[0].impacto_custo_validacao);
            if (dados[0].imagem_atual !== "") {
                $('#img-atual').replaceWith("<img id='img-atual' src='" + dados[0].imagem_atual + "' class='img-fluid'> ");
            } else {
                $('#img-atual').replaceWith("<img id='img-atual' src='" + diretorio + "resources/dist/img/atual.jpg' class='img-fluid'> ");
            }
            if (dados[0].imagem_proposta !== "") {
                $('#img-proposto').replaceWith("<img id='img-proposto' src='" + dados[0].imagem_proposta + "' class='img-fluid'> ");
            } else {
                $('#img-proposto').replaceWith("<img id='img-proposto' src='" + diretorio + "resources/dist/img/proposto.jpg' class='img-fluid'> ");
            }
            
            //forms com base no status - aprovações
            $('#table-aprovacao tbody').empty();

            //pré aprovar
            if (dados[0].id_submissao_status == 1) {
                $("#form-pre-aprovacao").removeClass("hidden");
                $("#form-aprovacao").addClass("hidden");
                $("#table-aprovacao").addClass("hidden");
                $("#form-cancelar-submissao");
            }

            //aprovação
            if (dados[0].id_submissao_status === 2 || dados[0].id_submissao_status === 3 || dados[0].id_submissao_status === 4 || dados[0].id_submissao_status === 9) {
                $("#form-pre-aprovacao").addClass("hidden");
                $("#form-cancelar-submissao").remove();

                let idSubmissao = dados[0].id_submissao;
                let idDepartamento = dados[0].id_departamento;
                let selectDepartamento = $('#select-departamento').val();
                //console.log(idSubmissao, idDepartamento);

                $.ajax({
                    url: diretorio + 'submissao/listarPerguntaAprovacao',
                    type: 'POST',
                    data: { idSubmissao, idDepartamento },
                    error: function (result) {
                        //console.log(result);
                        mensagem('danger', 'Falha ao buscar dados para aprovação da submissão');
                    },
                    success: function (result) {
                        //console.log(result);
                        //limpa a tabela para exibicao de novos resultados

                        $('#table-aprovacao tbody').empty();
                        $('#table-aprovacao').removeClass("hidden");
                        $("#form-aprovacao").removeClass("hidden");

                        if (result) {
                            let aprovacao = JSON.parse(result);
                            resposta = '';
                            let tabela = $('#table-aprovacao');
                            var rows = "";
                            var usuario_logado = $('#usuario_ativo').val();

                            //var departamento_selecionado = $('#departamento_ativo').val();

                            var a = false;
                            var b = false;
                            var c = false;

                            $.each(aprovacao, function (i, aprovacoes) {
                                console.log(aprovacoes);
                                switch (aprovacoes.resposta) {
                                    case 's':
                                        resposta = 'Aprovado';
                                        break;
                                    case 'n':
                                        resposta = 'Reprovado';
                                        break;
                                    case 'na':
                                        resposta = 'Opcional';
                                        break;
                                    case 'ppap':
                                        resposta = 'Revalid. PPAP';
                                        break;
                                    default:
                                        resposta = '';
                                        break;
                                }

                                if (aprovacoes.comentario == null) {
                                    comentario = "";
                                } else {
                                    comentario = aprovacoes.comentario;
                                }

                                if (aprovacoes.data_criacao == null) {
                                    data_criacao = "";
                                } else {
                                    data_criacao = aprovacoes.data_criacao;
                                }

                                rows += "<tr class='font-weight-light text-capitalize'>";
                                rows += "<td class='text-center'><a href='#' class='text-success btn-usuarios-departamento' data-id='" + aprovacoes.id_departamento + "'><i class='far fa-eye'></i></a><div data-div-usuarios-" + aprovacoes.id_departamento + "></div></td>";
                                rows += " <td>" + aprovacoes.usuario_aprovacao + "</td>";
                                rows += " <td>" + aprovacoes.nome + "</td>";
                                rows += " <td>" + resposta + "</td>";
                                rows += " <td>" + comentario + "</td>";
                                rows += " <td>" + data_criacao + "</td>";
                                rows += "</tr>";
                                //console.log(aprovacoes.usuario_ad +' - '+ usuario_logado);
                                if (aprovacoes.usuario_ad == usuario_logado) {
                                    a = true;
                                    if (aprovacoes.id_departamento == selectDepartamento && resposta !== "" && resposta !== "Revalid. PPAP") {
                                        b = true;
                                        c = true;
                                    }
                                }

                                tabela.find("tbody").html(rows);
                            });

                            $('.btn-usuarios-departamento').click(listarUsuariosDepartamento);

                            if (a == true && b == true && c == true) {
                                $("#form-aprovacao").addClass("hidden");
                            } else {
                                $("#form-aprovacao").removeClass("hidden");
                            }
                        }
                    }
                });
            }

            //visualizacao - desabilita edição de documento
            var btnSmppVisualizar = $("#btn-smpp-visualizar");
            if (btnSmppVisualizar.hasClass('active')) {
                $("#form-pre-aprovacao").addClass("hideTable");
                $("#form-aprovacao").addClass("hideTable");
                $("#cancelar-smpp").addClass("hideTable");
            } else {
                $("#form-pre-aprovacao").removeClass("hideTable");
                $("#form-aprovacao").removeClass("hideTable");
                $("#cancelar-smpp").removeClass("hideTable");
            }

            break;
        default:
            break;
    }
}

function listarUsuariosDepartamento() {
    //listar usuários departamento                    
    const idDepartamento = $(this).attr('data-id');
    
    $.ajax({
        url: diretorio + 'departamento/listarUsuariosDepartamento/',
        type: 'POST',
        data: { idDepartamento: idDepartamento },
        error: function (result) {
            //console.log(result);
            mensagem('danger', 'Falha ao exibir dados. Contate o Adminsitrador do Sistema.');
        },
        success: function (result) {
            //console.log(result);
            let usuarios = JSON.parse(result);
            let divUsuarios = document.querySelector('[data-div-usuarios-' + idDepartamento + ']');
            divUsuarios.innerHTML = '';
            let nomes = '';
            usuarios.forEach(item => {
                nomes += item.usuario + ', ';
            });
            divUsuarios.append(nomes);
            setInterval(() => divUsuarios.innerHTML = '', 3500);
        }
    });
}

function meudepartamento(tabela, id) {

    if (id != '' && tabela != '') {
        let url = diretorio + 'departamento/listartudo';
        let selectDepartamento = $('#select-departamento');

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
                let dados = JSON.parse(result);
                $.each(dados, function (i, item) {
                    let option = $('<option>');
                    option.val(item.id_departamento).text(`${item.departamento} - ${item.filial} - ${item.pais}`);
                    selectDepartamento.append(option);
                });
            }
        });
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

//FILIAL //

//listar filial
function listarFiliais(idPais) {
    if (idPais) {

        $('#input-id-pais').val(idPais);
        let selectFilial = $('#select-filial');

        let delOption = selectFilial.find('option');
        delOption.remove();
        let option = $('<option>');
        option.val('').text('-- Selecione ou adicione --').attr('disabled', true).attr('selected', true);
        selectFilial.append(option);

        $.ajax({
            url: diretorio + 'filial/listar',
            type: 'POST',
            data: { id_pais: idPais },
            error: function (result) {
                //console.log(result);
            },
            success: function (result) {

                switch (result) {
                    case 'erro':
                        break;
                    default:
                        let dados = JSON.parse(result);

                        $.each(dados, function (i, item) {
                            let option = $('<option>');
                            option.val(item.id_filial).text(item.nome);
                            selectFilial.append(option);
                        });
                        break;
                }
            }
        });
        selectFilial.addClass('text-capitalize');
    }
}

//abas
function voltarPais() {
    $('#tab-pais-tab').addClass('active').attr('selected', true).attr('aria-selected', true);
    $('#tab-filial-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');
    $('#tab-departamento-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');

    $('#tab-pais').addClass('active').addClass('show');
    $('#tab-filial').removeClass('active').removeClass('show');
    $('#tab-departamento').removeClass('active').removeClass('show');

    $('#next-departamento').attr('disabled', true);
}

//abas
function voltarFilial() {
    $('#tab-pais-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');
    $('#tab-filial-tab').addClass('active').attr('selected', true).attr('aria-selected', true);
    $('#tab-departamento-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');

    $('#tab-pais').removeClass('active').removeClass('show');
    $('#tab-filial').addClass('active').addClass('show');
    $('#tab-departamento').removeClass('active').removeClass('show');
}

function proximoFilial() {
    let nomePais = $('#select-pais option:selected').text();
    let idPais = $('#select-pais option:selected').val();

    $('#tab-pais-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');
    $('#tab-filial-tab').addClass('active').attr('selected', true).attr('aria-selected', true);
    $('#tab-departamento-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');

    $('#tab-pais').removeClass('active').removeClass('show');
    $('#tab-filial').addClass('active').addClass('show');
    $('#tab-departamento').removeClass('active').removeClass('show');

    $('.pais').text(nomePais).addClass('text-capitalize');

    listarFiliais(idPais);
}

function proximoDepartamento() {
    let nomeFilial = $('#select-filial option:selected').text();
    let idFilial = $('#select-filial option:selected').val();

    $('#tab-pais-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');
    $('#tab-filial-tab').removeClass('active').attr('selected', false).attr('aria-selected', false).addClass('disabled');
    $('#tab-departamento-tab').addClass('active').attr('selected', true).attr('aria-selected', true);

    $('#tab-pais').removeClass('active').removeClass('show');
    $('#tab-filial').removeClass('active').removeClass('show');
    $('#tab-departamento').addClass('active').addClass('show');

    $('.filial').text(nomeFilial).addClass('text-capitalize');
    $('#input-id-filial').val(idFilial);
}

function ativarFilial() {
    let idPais = $(this).val();
    if (idPais) {
        $("#next-filial").removeClass('disabled').attr('disabled', false);
    }
}

function ativarDepartamento() {
    let idFilial = $(this).val();
    if (idFilial) {
        $('#next-departamento').attr('disabled', false).removeClass('disabled');
        $('#input-id-filial').val(idFilial);
    }
}

$('#select-pais').change(ativarFilial);
$('#select-filial').change(ativarDepartamento);

$('#back-pais').click(voltarPais);
$('#back-filial').click(voltarFilial);

$('#next-filial').click(proximoFilial);
$('#tab-filial-tab').click(proximoFilial);

$('#next-departamento').click(proximoDepartamento);

//END FILIAL //


// SUBMISSÃO - SELECIONAR DEPARTAMENTO //

//selecionar departamento
$('#select-departamento').change(selecionarDepartamento);
function selecionarDepartamento() {
    let idDepartamento = $(this).val();
    if (idDepartamento) {
        //console.log(idDepartamento);
        $("#form-departamento-smpp").submit();
    }
}

//salvar pré-aprovação
$('.form-aprovacao-submissao').submit(function (event) {
    event.preventDefault();
    let form = $(this);
    let acao = form.attr("data-id");
    let dados = form.serialize();

    //console.log(dados, acao);
    $('.btn-submit-register').attr('disabled', true);
    $.ajax({
        url: diretorio + 'submissao/' + acao,
        type: 'POST',
        data: dados,
        error: function (result) {
            console.log(result);
            mensagem('error', 'Falha ao aprovar/reprovar submissão. Contate o Adminsitrador do sistema.');
            $('.btn-submit-register').attr('disabled', false);
        },
        success: function (result) {
            console.log(result);
            if (result) {
                //$(".modal").modal("hide");
                mensagem('success', 'Registrada aprovação/reprovação com sucesso! Sua página será recarregada.');
                setTimeout(() => location.reload(), 2000);
            } else {
                mensagem('warning', 'Falha ao registrar aprovação/reprovação da submissão, verifique dados selecionados.');
                $('.btn-submit-register').attr('disabled', false);
            }
        }
    });


});

//oculta / exibe campo documento cliente
$('#input-solicitacao-cliente').click(function () {
    var $that = $(this);

    if ($that.prop("checked", true)) {
        $('#div-input-documento-cliente').show();
        console.log('show');
    }
});

//oculta / exibe campo documento cliente
$('#input-solicitacao-interna').click(function () {
    var $that = $(this);

    if ($that.prop("checked", true)) {
        $('#div-input-documento-cliente').hide();
        console.log('hide');
    }
});

function atualizaStageKickoff(e) {
    id_stage_gate = $("#view-id-stage-gate").val();
    coluna = 'data_inicio';
    data = e.target.value;
    $.ajax({
        url: diretorio + 'stage/atualizastagegate/' + id_stage_gate,
        type: 'POST',
        data: { coluna: coluna, data: data, id: id_stage_gate },
        error: function (result) {
            console.log(result);
            mensagem('danger', 'Falha ao registrar. Contate o Adminsitrador do Sistema.');
        },
        success: function (result) {
            console.log(result);
            switch (result.trim()) {
                case 'success':
                    mensagem('success', 'Data atualizada com sucesso!');
                    break;
                case 'erro':
                    mensagem('warning', 'Falha ao registrar, item existente ou dados inválidos! Por favor, verifique.');
                    break;
            }

        }
    });
    //alert(e.target.value);
}

function atualizaStageImplementation(e) {
    id_stage_gate = $("#view-id-stage-gate").val();
    coluna = 'data_implementacao';
    data = e.target.value;
    $.ajax({
        url: diretorio + 'stage/atualizastagegate/' + id_stage_gate,
        type: 'POST',
        data: { coluna: coluna, data: data, id: id_stage_gate },
        error: function (result) {
            mensagem('danger', 'Falha ao registrar. Contate o Adminsitrador do Sistema.');
        },
        success: function (result) {
            switch (result.trim()) {
                case 'success':
                    mensagem('success', 'Data atualizada com sucesso!');
                    break;
                case 'erro':
                    mensagem('warning', 'Falha ao registrar, item existente ou dados inválidos! Por favor, verifique.');
                    break;
            }

        }
    });
}

function atualizaStageReview(e) {
    id_stage_gate = $("#view-id-stage-gate").val();
    coluna = 'data_revisao';
    data = e.target.value;
    $.ajax({
        url: diretorio + 'stage/atualizastagegate/' + id_stage_gate,
        type: 'POST',
        data: { coluna: coluna, data: data, id: id_stage_gate },
        error: function (result) {
            mensagem('danger', 'Falha ao registrar. Contate o Adminsitrador do Sistema.');
        },
        success: function (result) {
            switch (result.trim()) {
                case 'success':
                    mensagem('success', 'Data atualizada com sucesso!');
                    break;
                case 'erro':
                    mensagem('warning', 'Falha ao registrar, item existente ou dados inválidos! Por favor, verifique.');
                    break;
            }

        }
    });
}


//exibe tela de finalização de Change Management Gate
$('#botao-finalizar-stage-gate').click(function () {
    id_stage_gate = $("#view-id-stage-gate").val();
    $("#modal-finalizar-stage-gate").modal("show");
});

function atualizaStageFinal() {
    id_stage_gate = $("#view-id-stage-gate").val();
    observacao = $("#text-finalizar-stage-gate").val();
    coluna = 'observacao_final';

    $('.btn-submit-register').attr('disabled', false);
    if (observacao !== "") {
        $.ajax({
            url: diretorio + 'stage/atualizastagegate/' + id_stage_gate,
            type: 'POST',
            data: { coluna: coluna, data: observacao, id: id_stage_gate },
            error: function (result) {
                mensagem('danger', 'Falha ao registrar. Contate o Adminsitrador do Sistema.');
            },
            success: function (result) {
                switch (result.trim()) {
                    case 'success':
                        mensagem('success', 'Change Management Gate finalizado com sucesso!');
                        $("#modal-finalizar-stage-gate").modal("hide");
                        setTimeout(() => location.replace(diretorio + 'stage/'), 2000);
                        break;
                    case 'erro':
                        mensagem('warning', 'Falha ao registrar, item existente ou dados inválidos! Por favor, verifique.');
                        break;
                }
            }
        });
    } else {
        mensagem('warning', 'Campos obrigatórios não foram preenchidos.');
    }
}

$('#input-confirm-cancel-smpp').keyup(function () {
    const cancelar = "CANCELAR";
    let conf = $(this).val().toUpperCase();
    
    if (conf == cancelar){
        $('#cancelar-nova-smpp').removeAttr("disabled");
        $('#cancelar-stage').removeAttr("disabled");
    }else{
        $('#cancelar-nova-smpp').prop("disabled", true);
        $('#cancelar-stage').prop("disabled", true);
    }
});

//cancelar submissao
$('#cancelar-nova-smpp').click(function() {
    cancelaSMPP('smpp');
});


$('#cancelar-stage').click(function () {
    cancelaSMPP('cmg');
});


function cancelaSMPP(tipo) {
    let acao = $('.form-cancelar-submissao').attr("data-id");
    let dados = $('.form-cancelar-submissao').serialize(); 
    //let tipo = tipo;

    $.ajax({
        url: diretorio + 'submissao/' + acao,
        type: 'POST',
        data: dados,
        error: function (result) {
            mensagem('error', 'Falha ao cancelar submissão. Contate o Adminsitrador do sistema.');
        },
        success: function (result) {
            if (result) {
                mensagem('success', 'Submissão cancelada com sucesso! Sua página será recarregada.');
                $("#input-confirm-cancel-smpp").val("");
                $("#modal-cancelar-smpp").modal("hide");
                if(tipo == 'cmg'){
                    setTimeout(() => location.replace(diretorio + 'stage/'), 2000);
                }else{
                    setTimeout(() => location.reload(), 2000);
                }                
            } else {
                mensagem('warning', 'Falha ao cancelar submissão, verifique dados selecionados.');
            }
        }
    });
}




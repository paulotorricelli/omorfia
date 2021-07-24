/* 

DATATABLES 

*/
$(function () {
    $(".table-management").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
    });
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
            $("#input-nome-modal").val(dados.nome);
            $("#input-sobrenome-modal").val(dados.sobrenome);
            $("#input-telefone-modal").val(dados.telefone);
            $("#input-celular-modal").val(dados.celular);
            $("#input-rg-modal").val(dados.rg);
            $("#input-cpf-modal").val(dados.cpf);
            $("#input-como-conheceu-modal").val(dados.como_conheceu);
            $("#input-email-modal").val(dados.email);
            $("#input-data-nascimento-modal").val(dados.data_nascimento);
            $("#input-instagram-modal").val(dados.instagram);
            $("#input-facebook-modal").val(dados.facebook);
            $("#input-hobby-modal").val(dados.hobby);
            $("#input-cep-modal").val(dados.cep);
            $("#input-endereco-modal").val(dados.endereco);
            $("#input-numero-modal").val(dados.numero);
            $("#input-complemento-modal").val(dados.complemento);
            $("#input-bairro-modal").val(dados.bairro);
            $("#input-cidade-modal").val(dados.cidade);
            $("#input-uf-modal").val(dados.uf);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        case "funcionario":
            $("#input-id-modal").val(dados.id_usuario);
            $("#input-nome-modal").val(dados.nome);
            $("#input-sobrenome-modal").val(dados.sobrenome);
            $("#input-telefone-modal").val(dados.telefone);
            $("#input-celular-modal").val(dados.celular);
            $("#input-email-modal").val(dados.email);
            $("#input-data-nascimento-modal").val(dados.data_nascimento);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            menus(dados.id_usuario);
            break;
        case "procedimento":
            $("#input-id-modal").val(dados.id_procedimento);
            $("#input-nome-modal").val(dados.nome);
            $("#input-valor-venda-modal").val(dados.valor);
            $("#input-descricao-modal").val(dados.descricao);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        case "produto":
            $("#input-id-modal").val(dados.id_produto);
            $("#input-nome-modal").val(dados.nome);
            $("#input-valor-venda-modal").val(dados.valor_venda);
            $("#input-descricao-modal").val(dados.descricao);
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
function modal(event) {
    event.preventDefault();

    const idItem = $(this).attr("id");
    const typeItem = $(this).attr("data-id");

    if (!idItem || !typeItem) {
        toastr.warning("Falha ao listar itens, dados necessários inválidos.");
        return false;
    }

    console.log(idItem, typeItem);

    $.ajax({
        url: diretorio +'/'+ typeItem + "/lista",
        type: "GET",
        data: { id: idItem },
        error: function (error) {
            toastr.error(
                "Ocorreu um erro ao listar o item selecionado, contate o administrador do sistema."
            );
        },
        success: function (result) {
            console.log(result);
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
$(".btn-modal").click(modal);

/*

LISTAR MENUS DO USUÁRIOS - MODAL EDITAR USUÁRIO

*/
function menus(id) {
    $.ajax({
        url: diretorio + "/menu/usuario",
        type: "GET",
        data: { id: id },
        error: function (error) {
            //console.log(error);
            toastr.error(
                "Falha ao listar menus do usuário. Contate o Administrador."
            );
        },
        success: function (result) {
            //menus
            let divMain = $("#div-principal");
            let divGerenciar = $("#div-gerenciar");

            //limpando antigos
            let delDiv = divMain.find("div");
            delDiv.remove();
            delDiv = divGerenciar.find("div");
            delDiv.remove();

            //montando checkbox
            let div = [];
            let input = [];
            let label = [];

            let menus = JSON.parse(result);
            $.each(menus, function (i, item) {
                div[i] = $("<div>");
                input[i] = $("<input>");
                label[i] = $("<label>");

                let id = "model-menu-" + item.id_menu;

                switch (item.tipo) {
                    case "lateral-principal":
                        div[i].addClass("custom-control custom-checkbox");
                        input[i]
                            .attr("type", "checkbox")
                            .attr("id", id)
                            .attr("checked", item.id_menu == 1 ? false : false)
                            .attr("disabled", item.id_menu == 1 ? false : false) //1 - dashboard
                            .attr("name", "menus[]")
                            .val(item.id_menu)
                            .addClass("custom-control-input")
                            .addClass("custom-control-input-info");
                        item.id_usuario
                            ? input[i].attr("checked", true)
                            : input[i].attr("checked", false);
                        label[i]
                            .attr("for", id)
                            .addClass("custom-control-label")
                            .text(item.aba);

                        div[i].append(input[i]);
                        div[i].append(label[i]);
                        divMain.append(div[i]);
                        break;
                    case "lateral-gerenciamento":
                        div[i].addClass("custom-control custom-checkbox");
                        input[i]
                            .attr("type", "checkbox")
                            .attr("id", id)
                            .attr("name", "menus[]")
                            .val(item.id_menu)
                            .addClass("custom-control-input")
                            .addClass("custom-control-input-info");
                        item.id_usuario
                            ? input[i].attr("checked", true)
                            : input[i].attr("checked", false);
                        label[i]
                            .attr("for", id)
                            .addClass("custom-control-label")
                            .text(item.aba);

                        div[i].append(input[i]);
                        div[i].append(label[i]);
                        divGerenciar.append(div[i]);
                        break;
                    default:
                        toastr.error("Falha ao buscar lista de menus de acesso.");
                        break;
                }
            });
        },
    });
}

/*

ALTERAR STATUS

*/
function status() {
    let dados = new Array(...$(this).attr("data-id").split("/"));
    let radio = $(this);
    radio.attr("disabled", true);

    if (dados) {
        let tabela = dados[0];
        let status = dados[1];
        let id = dados[2];
        console.log(tabela);
        $.ajax({
            url: diretorio + '/' + tabela + "/status",
            type: "POST",
            data: { tabela, status, id },
            error: function (error) {
                console.log(error);
                toastr.error(
                    "Erro ao alterar status. Contate o Adminsitrador do Sistema."
                );
                radio.attr("disabled", false);
            },
            success: function (result) {
                result = result.trim();
                result
                    ? toastr.success("Status alterado com sucesso!")
                    : toastr.warning("Falha ao alterar status.");
                radio.attr("disabled", false);
            },
        });
    } else {
        toastr.warning("Falha ao alterar status.");
        radio.attr("disabled", false);
    }
}
$(".radio-status").click(status);
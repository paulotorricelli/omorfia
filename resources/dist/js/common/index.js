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
            $("#input-email-modal").val(dados.email);
            $("#input-data-nascimento-modal").val(dados.data_nascimento);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            break;
        case "usuario":
            $("#input-id-modal").val(dados.id_cliente);
            $("#input-nome-modal").val(dados.nome);
            $("#input-sobrenome-modal").val(dados.sobrenome);
            $("#input-telefone-modal").val(dados.telefone);
            $("#input-celular-modal").val(dados.celular);
            $("#input-email-modal").val(dados.email);
            $("#input-data-nascimento-modal").val(dados.data_nascimento);
            $("#input-data-criacao").html(dateFormat(dados.data_criacao));
            $("#input-data-modificacao").html(dateFormat(dados.data_modificacao));
            listarMenusUsuario(dados.id_usuario);
            break;
        default:
            toastr.warning("Falha ao listar os dados no modal.");
    }
}

/* 

GET DATA + OPEN MODAL

*/
function abreModal(event) {
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
$(".btn-modal").click(abreModal);

/*

LISTAR MENUS DO USUÁRIOS - MODAL EDITAR USUÁRIO

*/
function listarMenusUsuario(id) {
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
                            .attr("checked", item.id_menu == 1 ? true : false)
                            .attr("disabled", item.id_menu == 1 ? true : false) //1 - dashboard
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
                    case "lateral-gerenciar":
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
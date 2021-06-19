
document.addEventListener("DOMContentLoaded", function () {
    if (!$.fn.dataTable.isDataTable('.table-gerenciamento')) {
        $(".table-gerenciamento").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }

    if (!$.fn.dataTable.isDataTable('.table-smpp')) {
        $(".table-smpp").DataTable({
            "order": [[0, "desc"]],
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }

    if (!$.fn.dataTable.isDataTable('.table-stage')) {
        $(".table-stage").DataTable({
            "order": [[0, "desc"]],
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }

    if (!$.fn.dataTable.isDataTable('.table-stage-edit')) {
        $(".table-stage-edit").DataTable({
            "order": [[3, "desc"]],
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }

    if (!$.fn.dataTable.isDataTable('.table-stage-view')) {
        $(".table-stage-view").DataTable({
            "order": [[3, "desc"]],
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }
});

$("#table-stage-edit tr").editable({
    keyboard: true,
    dblclick: true,
    button: true,
    buttonSelector: ".edit",
    dropdowns: {
        alteracao_necessaria:['No','Yes'],
        avaliacao_item: ['Green','Yellow','Red', 'NA'],
        //comentario:[]
    },
    maintainWidth: true,
    edit: function (values) {
        $(".edit i", this)
            .removeClass('fa-pencil')
            .addClass('fa-save')
            .attr('title', 'Save');
        $("td[data-field='data_planejada'] input", this).attr('type', 'date');
        $("td[data-field='data_finalizada'] input", this).attr('type', 'date');
        $("td[data-field='comentario'] input", this).attr('list', 'opcoes-comentario');
        $("td[data-field='comentario']", this).append("<datalist id='opcoes-comentario'></datalist>");
        comentarios_aprovacao($("#view-id-submissao").val());
    },
    save: function (values) {
        var id = $(this).data('id');
        $.post(diretorio + '/stage/atualizarperguntas/' + id, values);
        console.log(values);

        $(".edit i", this)
            .removeClass('fa-save')
            .addClass('fa-pencil')
            .attr('title', 'Edit'); 
        //altera fundo yes no
        if ($("td[data-field='alteracao_necessaria']", this).text() == "Yes"){
                $("td[data-field='alteracao_necessaria']", this)
                    .removeClass('bg-success')
                    .addClass('bg-warning');
        }else{
                $("td[data-field='alteracao_necessaria']", this)
                    .removeClass('bg-warning')
                    .addClass('bg-success');
        }
        switch ($("td[data-field='avaliacao_item']", this).text()) {
            case 'Green':
                $("td[data-field='avaliacao_item']", this)
                    //.removeClass('bg-success')
                    .removeClass('bg-warning')
                    .removeClass('bg-danger')
                    .addClass('bg-success');
            break;
            case 'Yellow':
                $("td[data-field='avaliacao_item']", this)
                    .removeClass('bg-success')
                    //.removeClass('bg-warning')
                    .removeClass('bg-danger')
                    .addClass('bg-warning');
            break;
            case 'Red':
                $("td[data-field='avaliacao_item']", this)
                    .removeClass('bg-success')
                    .removeClass('bg-warning')
                    //.removeClass('bg-danger')
                    .addClass('bg-danger');
            break;
            case 'NA':
                $("td[data-field='avaliacao_item']", this)
                    .removeClass('bg-success')
                    .removeClass('bg-warning')
                    .removeClass('bg-danger');
            break;
        }  

        //location.reload();    
    },
    cancel: function (values) { }

});

//trocar de tabelas SMPP
var btnSmppVisualizar = document.getElementById("btn-smpp-visualizar");
var btnSmppGestao = document.getElementById("btn-smpp-gestao");
var btnSmppDepartamento = document.getElementById("btn-smpp-departamento");
var btnSmppUser = document.getElementById("btn-smpp-user");

var tabelaSmppVisualizar = document.getElementById("smpp-visualizar");
var tabelaSmppGestao = document.getElementById("smpp-gestao");
var tabelaSmppDepartamento = document.getElementById("smpp-departamento");
var tabelaSmppUser = document.getElementById("smpp-user");



if (btnSmppVisualizar) {
    btnSmppVisualizar.addEventListener("click", function (event) {
        event.preventDefault();

        btnSmppUser ? btnSmppUser.classList.remove("active") : '';
        btnSmppDepartamento ? btnSmppDepartamento.classList.remove("active") : '';
        btnSmppGestao ? btnSmppGestao.classList.remove("active") : '';
        btnSmppVisualizar ? btnSmppVisualizar.classList.add("active") : '';

        tabelaSmppUser.classList.add("hideTable");
        tabelaSmppUser.classList.remove("table-gerenciamento");

        if (tabelaSmppDepartamento) {
            tabelaSmppDepartamento.classList.add("hideTable");
            tabelaSmppDepartamento.classList.remove("table-gerenciamento");
        }

        if (tabelaSmppGestao) {
            tabelaSmppGestao.classList.add("hideTable");
            tabelaSmppGestao.classList.remove("table-gerenciamento");
        }
        if (tabelaSmppVisualizar) {
            tabelaSmppVisualizar.classList.remove("hideTable");
            tabelaSmppVisualizar.classList.add("table-gerenciamento");

        }
    });
}

if (btnSmppGestao) {
    btnSmppGestao.addEventListener("click", function (event) {
        event.preventDefault();

        btnSmppUser ? btnSmppUser.classList.remove("active") : '';
        btnSmppDepartamento?btnSmppDepartamento.classList.remove("active"):'';
        btnSmppGestao?btnSmppGestao.classList.add("active"):'';
        btnSmppVisualizar ? btnSmppVisualizar.classList.remove("active") : '';

        tabelaSmppUser.classList.add("hideTable");
        tabelaSmppUser.classList.remove("table-gerenciamento");

        if (tabelaSmppDepartamento) {
            tabelaSmppDepartamento.classList.add("hideTable");
            tabelaSmppDepartamento.classList.remove("table-gerenciamento");
        }

        if (tabelaSmppGestao) {
            tabelaSmppGestao.classList.remove("hideTable");
            tabelaSmppGestao.classList.add("table-gerenciamento");
        }
        if (tabelaSmppVisualizar) {
            tabelaSmppVisualizar.classList.add("hideTable");
            tabelaSmppVisualizar.classList.remove("table-gerenciamento");
        }
    });
}

if (btnSmppDepartamento) {
    btnSmppDepartamento.addEventListener("click", function (event) {
        event.preventDefault();

        btnSmppUser ? btnSmppUser.classList.remove("active") : '';
        btnSmppDepartamento?btnSmppDepartamento.classList.add("active"):'';
        btnSmppGestao?btnSmppGestao.classList.remove("active"):'';
        btnSmppVisualizar ? btnSmppVisualizar.classList.remove("active") : '';

        tabelaSmppUser.classList.add("hideTable");
        tabelaSmppUser.classList.remove("table-gerenciamento");

        if (tabelaSmppDepartamento) {
            tabelaSmppDepartamento.classList.remove("hideTable");
            tabelaSmppDepartamento.classList.add("table-gerenciamento");
        }
        if (tabelaSmppGestao) {
            tabelaSmppGestao.classList.add("hideTable");
            tabelaSmppGestao.classList.remove("table-gerenciamento");
        }
        if (tabelaSmppVisualizar) {
            tabelaSmppVisualizar.classList.add("hideTable");
            tabelaSmppVisualizar.classList.remove("table-gerenciamento");
        }
    });
}

if (btnSmppUser) {
    btnSmppUser.addEventListener("click", function (event) {

        event.preventDefault();

        btnSmppUser ? btnSmppUser.classList.add("active") : '';
        btnSmppDepartamento?btnSmppDepartamento.classList.remove("active"):'';
        btnSmppGestao?btnSmppGestao.classList.remove("active"):'';
        btnSmppVisualizar ? btnSmppVisualizar.classList.remove("active") : '';

        tabelaSmppUser.classList.remove("hideTable");
        tabelaSmppUser.classList.add("table-gerenciamento");

        if (tabelaSmppDepartamento) {
            tabelaSmppDepartamento.classList.add("hideTable");
            tabelaSmppDepartamento.classList.remove("table-gerenciamento");
        }

        if (tabelaSmppGestao) {
            tabelaSmppGestao.classList.add("hideTable");
            tabelaSmppGestao.classList.remove("table-gerenciamento");
        }

        if (tabelaSmppVisualizar) {
            tabelaSmppVisualizar.classList.add("hideTable");
            tabelaSmppVisualizar.classList.remove("table-gerenciamento");
        }
    });
}

//insere os comentários da aprovação no select do stagegate
function comentarios_aprovacao(id) {
    let url = diretorio + '/stage/listarrespostasaprovacao/' + id;
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
                    //$('#opcoes-comentario').remove();
                    $.each(dados, function (i, item) {
                        let option = $('<option>');
                        option.val(item.comentario.toUpperCase()).text(item.comentario.toUpperCase());
                        $('#opcoes-comentario').append(option);
                    });
                break;
            }
        }
    });
}
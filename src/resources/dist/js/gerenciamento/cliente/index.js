function cadCliente(event) {
    event.preventDefault();

    let id = 'cliente';
    let form = $('#form-new-' + id);
    let url = form.attr("data-id");
    let data = form.serialize();

    console.log(form);
    console.log(url);

    if (form.valid()) {

        $(".btn-submit").attr("disabled", true);
        console.log(data);

        $.ajax({
            type: "POST",
            url: diretorio + "/" + url,
            data: data,
            success: function (data) {
                console.log(data);
                toastr.success("Cadastro realizado com sucesso.");
                location.reload();
            },
            error: function (data) {
                console.log(data);
                toastr.error("Ocorreu um erro ao cadastrar, contate o administrador do sistema.");
            }
        });
    } else {
        toastr.warning("Existem campos obrigatórios.");
        $(".btn-submit").attr("disabled", false);
    }

}

function updCliente(event) {
    event.preventDefault();

    let id = 'cliente';
    let form = $('#form-edit-' + id);
    let url = form.attr("data-id");
    let data = form.serialize();

    console.log(id);
    console.log(url);

    if (form.valid()) {

        $(".btn-submit-update").attr("disabled", true);
        console.log(data);

        $.ajax({
            type: "POST",
            url: diretorio + "/" + url,
            data: data,
            success: function (data) {
                console.log(data);
                $("#modal-" + id).modal("hide");
                toastr.success("Cadastro atualizado com sucesso.");
                location.reload();
            },
            error: function (data) {
                console.log(data);
                toastr.error("Ocorreu um erro ao cadastrar, contate o administrador do sistema.");
                $(".btn-submit-update").attr("disabled", false);
            }
        });
    } else {
        toastr.warning("Existem campos obrigatórios.");
        $(".btn-submit-update").attr("disabled", false);
    }

}

$('.btn-submit').click(cadCliente);
$('.btn-submit-update').click(updCliente);

function limpaFormularioCEP() {
    // Limpa valores do formulário de cep.
    $("#input-endereco").val("");
    $("#input-bairro").val("");
    $("#input-cidade").val("");
    $("#input-uf").val("");
}

function limpaFormularioCEPModal() {
    // Limpa valores do formulário de cep.
    $("#input-endereco-modal").val("");
    $("#input-bairro-modal").val("");
    $("#input-cidade-modal").val("");
    $("#input-uf-modal").val("");
}

//Quando o campo cep perde o foco.
$("#input-cep").blur(function () {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#input-endereco").val("...");
            $("#input-bairro").val("...");
            $("#input-cidade").val("...");
            $("#input-uf").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#input-endereco").val(dados.logradouro);
                    $("#input-bairro").val(dados.bairro);
                    $("#input-cidade").val(dados.localidade);
                    $("#input-uf").val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpaFormularioCEP();
                    toastr.warning("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpaFormularioCEP();
            toastr.warning("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpaFormularioCEP();
    }
});

//Quando o campo cep perde o foco.
$("#input-cep-modal").blur(function () {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#input-endereco-modal").val("...");
            $("#input-bairro-modal").val("...");
            $("#input-cidade-modal").val("...");
            $("#input-uf-modal").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#input-endereco-modal").val(dados.logradouro);
                    $("#input-bairro-modal").val(dados.bairro);
                    $("#input-cidade-modal").val(dados.localidade);
                    $("#input-uf-modal").val(dados.uf);
                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpaFormularioCEPModal();
                    toastr.warning("CEP não encontrado.");
                }
            });
        } //end if.
        else {
            //cep é inválido.
            limpaFormularioCEPModal();
            toastr.warning("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpaFormularioCEPModal();
    }
});
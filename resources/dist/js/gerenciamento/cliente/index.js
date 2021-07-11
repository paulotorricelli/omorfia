function cadCliente(event) {
    event.preventDefault();
    
    let id = $('form').attr("id");
    let url = $('form').attr("data-id");
    let form = $('#' + id);
    let data = form.serialize();

    console.log(id);
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
                toastr.success("Cadastro realizado com  sucesso.");
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

$('.btn-submit').click(cadCliente);
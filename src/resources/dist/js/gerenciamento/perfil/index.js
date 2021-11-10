function atualizar(event) {
    event.preventDefault();

    let id = 'perfil';
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

$('.btn-submit-update').click(atualizar);
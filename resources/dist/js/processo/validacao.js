$("#form-new-cliente").validate({
    rules: {
        nome: {
            required: true,
            minlength: 2,
        },
        sobrenome: {
            required: true,
            minlength: 2,
        },
        "data-nascimento": {
            required: true,
        },
        email: {
            required: true,
            pattern: "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$",
        },
        celular: {
            required: true,
            pattern: "[1-9]{2}[0-9]{5}[0-9]{4}$",
        },
    },
    messages: {
        nome: {
            required: "Digite o nome",
        },
        sobrenome: {
            required: "Digite o sobrenome",
        },
        "data-nascimento": {
            required: "Digite a data de nascimento",
        },
        email: {
            required: "Digite o email",
            pattern: "Email inválido",
        },
        celular: {
            required: "Digite o celular",
            pattern: "Use este formato 11900000000",
        },
    }
});
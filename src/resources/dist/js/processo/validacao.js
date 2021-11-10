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

$("#form-edit-cliente").validate({
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

$("#form-edit-perfil").validate({
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
        senha: {
            required: true,
            minlength: 8,
            maxlength: 72,
        },
        "confirmar-senha": {
            required: true,
            minlength: 8,
            maxlength: 72,
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
        senha: {
            required: "Por favor, digite uma senha válida.",
            minlength: "A senha deve conter no mínimo 8 caracteres",
            maxlength: "A senha deve conter no máximo 72 caracteres",
        },
        "confirmar-senha": {
            required: "Por favor, digite uma senha válida.",
            minlength: "A senha deve conter no mínimo 8 caracteres",
            maxlength: "A senha deve conter no máximo 72 caracteres",
        },
    }
});

$("#form-new-funcionario").validate({
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
        senha: {
            required: true,
            minlength: 8,
            maxlength: 72,
        },
        "confirmar-senha": {
            required: true,
            minlength: 8,
            maxlength: 72,
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
        senha: {
            required: "Por favor, digite uma senha válida.",
            minlength: "A senha deve conter no mínimo 8 caracteres",
            maxlength: "A senha deve conter no máximo 72 caracteres",
        },
        "confirmar-senha": {
            required: "Por favor, digite uma senha válida.",
            minlength: "A senha deve conter no mínimo 8 caracteres",
            maxlength: "A senha deve conter no máximo 72 caracteres",
        },
    }
});

$("#form-new-produto").validate({
    rules: {
        nome: {
            required: true,
            minlength: 2,
        },
        "valor-venda": {
            required: true,
            minlength: 2,
        },
        descricao: {
            required: true,
            minlength: 2,
        },
    },
    messages: {
        nome: {
            required: "Digite o nome",
        },
        "valor-venda": {
            required: "Digite o valor",
        },
        descricao: {
            required: "Digite uma descrição",
        },
    }
});

$("#form-new-procedimento").validate({
    rules: {
        nome: {
            required: true,
            minlength: 2,
        },
        "valor-venda": {
            required: true,
            minlength: 2,
        },
        descricao: {
            required: true,
            minlength: 2,
        },
    },
    messages: {
        nome: {
            required: "Digite o nome",
        },
        "valor-venda": {
            required: "Digite o valor",
        },
        descricao: {
            required: "Digite uma descrição",
        },
    }
});
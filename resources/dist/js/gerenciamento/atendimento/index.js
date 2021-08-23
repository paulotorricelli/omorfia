$('#input-cliente').val('');
$('#input-cliente').autocomplete({
    lookup: function (busca, done) {
        $.ajax({
            type: 'GET',
            url: diretorio + '/cliente/busca?busca=' + busca,
            dataType: 'json',
            success: function (response) {
                var result = { "suggestions": [] };
                for (var i = 0; i < response.length; i++) {
                    var obj = response[i];
                    if (obj.cpf == '' || obj.cpf == null) { cpf = '0'; } else { cpf = obj.cpf }
                    // Adiciona item a array
                    result.suggestions.push({
                        //value: obj.id_cliente + ' | ' + cpf + ' | ' + obj.nome + ' ' + obj.sobrenome, data: obj.id_cliente
                        value: obj.nome + ' ' + obj.sobrenome, data: obj.id_cliente
                    });
                }

                if (response.length == 0) {
                    //se não encontra nenhum
                }

                done(result); // Envia a resposta "formatada" pro autocomplete
            }
        });
    },
    onSelect: function (suggestion) {
        $('#input-id-cliente').val(suggestion.data);
        //console.log
        //$('#vpaciente').attr('readonly', 'readonly');
        //$('#formArmazenagemInspetor').submit();
    },
}); 

$('#input-procedimento').val('');
$('#input-procedimento').autocomplete({
    lookup: function (busca, done) {
        $.ajax({
            type: 'GET',
            url: diretorio + '/procedimento/busca?busca=' + busca,
            dataType: 'json',
            success: function (response) {
                var result = { "suggestions": [] };
                for (var i = 0; i < response.length; i++) {
                    var obj = response[i];

                    // Adiciona item a array
                    result.suggestions.push({
                        //value: obj.id_cliente + ' | ' + cpf + ' | ' + obj.nome + ' ' + obj.sobrenome, data: obj.id_cliente
                        value: obj.nome, data: obj.id_procedimento
                    });
                }

                if (response.length == 0) {
                    //se não encontra nenhum
                }

                done(result); // Envia a resposta "formatada" pro autocomplete
            }
        });
    },
    onSelect: function (suggestion) {
        $('#input-id-procedimento').val(suggestion.data);
        //console.log
        //$('#vpaciente').attr('readonly', 'readonly');
        //$('#formArmazenagemInspetor').submit();
    },
});
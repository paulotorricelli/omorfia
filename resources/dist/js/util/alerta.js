
//alertas de mensagem para o sistema. Passar o tipo e a mensagem desejada.
function mensagem(tipo,mensagem='Empty(!)') {
    switch (tipo) {
        case 'success':
            toastr.success(mensagem);
            break;
        case 'info':
            toastr.info(mensagem);
            break;
        case 'danger':
            toastr.error(mensagem);
            break;
        case 'warning':
            toastr.warning(mensagem);
            break;
        default:
            toastr.info(mensagem);
    }
}
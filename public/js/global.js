var global = {

    confirmar: function (url, msg) {
        if (msg == '' || msg == undefined) {
            msg = 'Tem certeza?';
        }

        if (confirm(msg)) {
            location = url;
        }
    },
};
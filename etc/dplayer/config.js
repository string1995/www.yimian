
docute.init({
    landing: 'landin.html',
    plugins: [evanyou()]
});

function player () {
    return function (context) {
        context.event.on('content:updated', function () {
            for (let i = 0; i < document.querySelectorAll('.load').length; i++) {
                document.querySelectorAll('.load')[i].addEventListener('click', function () {
                    window[this.parentElement.id] && window[this.parentElement.id]();
                });
            }
        });
    };
}

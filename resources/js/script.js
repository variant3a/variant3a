import bootstrap from 'bootstrap/dist/js/bootstrap.bundle'

$(() => {
    const tooltipTriggerList = $('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    Turbolinks.start()

    hljs.highlightAll()

    twinkleIcon()
    setInterval(twinkleIcon, 5000)

})

function twinkleIcon() {
    $('li.nav-item').each(function (i, val) {
        const interval = 500 + i * 70
        const elem = $(this).find('i')
        setTimeout(() => {
            elem.css('transition', '0.2s')
            elem.css('color', 'white')
            setTimeout(() => {
                elem.css('color', '')
                setTimeout(() => {
                    elem.attr('style', '')
                }, 300)
            }, 300)
        }, interval)
    })
}

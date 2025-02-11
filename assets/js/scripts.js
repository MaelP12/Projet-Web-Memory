/*
function initcapybara() {
    let main        = document.querySelector('#main'),
        quantity    = 15;

    for(i=0; i<quantity; i++) {
        let top= randomNbr(-750, 0),
            left    = randomNbr(0, window.innerWidth),
            html    = `<img class="capybara" style="top:${top}px; left:${left}px" src="assets/images/capybara.png">`;
        main.insertAdjacentHTML( 'beforeend', html);
    }
}


addEventListener("DOMContentLoaded", (event) => {
    initcapybara()
});

window.setInterval(initcapybara, 5000);

window.setInterval(function() {
    document.querySelectorAll('.capybara').forEach((item) => {
        item.remove();
    });
}, 10000)


function randomNbr(min, max) { // min and max included
    return Math.floor(Math.random() * (max - min + 1) + min);
}
 */
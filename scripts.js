const link = document.querySelector('#short-link');

const container = document.getElementById('container');

container.addEventListener('click', event => {
    link.select();
    link.copyText.setSelectionRange(0, 99999);

    document.execCommand("copy");

    console.log(link);
});
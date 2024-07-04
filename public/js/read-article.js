// Syntax highlight

document.addEventListener('DOMContentLoaded', function() {
    let code1 = document.querySelectorAll('pre > code');
    let code2 = document.querySelectorAll('p > code');

    code1.forEach(value => {
        value.classList='';
        value.className += 'language-js';
    });

    code2.forEach(value => {
        value.classList='';
        value.className += 'language-js';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    Prism.highlightAll();
});
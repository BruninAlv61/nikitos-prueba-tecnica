const nav = document.querySelector('.nav');
const menuButton = document.querySelector('.menu-button');
const menuClose = document.querySelector('.menu-close');
const overlay = document.querySelector('.overlay');

menuButton.addEventListener('click', () => {
    nav.classList.add('nav--open');
    overlay.classList.add('overlay--visible');
    menuButton.classList.add('hidden');
});

const closeNav = () => {
    nav.classList.remove('nav--open');
    overlay.classList.remove('overlay--visible');
    menuButton.classList.remove('hidden');
};

menuClose.addEventListener('click', closeNav);
overlay.addEventListener('click', closeNav);
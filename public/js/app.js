const nav = document.querySelector('.nav');
const menuButton = document.querySelector('.menu-button');
const menuClose = document.querySelector('.menu-close');
const overlay = document.querySelector('.overlay');
const userMenuRoots = document.querySelectorAll('[data-user-menu]');

const closeUserMenu = (root) => {
    const toggle = root.querySelector('.header-user-menu__toggle');
    const dropdown = root.querySelector('.header-user-menu__dropdown');
    if (!toggle || !dropdown) {
        return;
    }
    dropdown.hidden = true;
    toggle.setAttribute('aria-expanded', 'false');
};

const openUserMenu = (root) => {
    userMenuRoots.forEach((other) => {
        if (other !== root) {
            closeUserMenu(other);
        }
    });
    const toggle = root.querySelector('.header-user-menu__toggle');
    const dropdown = root.querySelector('.header-user-menu__dropdown');
    if (!toggle || !dropdown) {
        return;
    }
    dropdown.hidden = false;
    toggle.setAttribute('aria-expanded', 'true');
};

const isUserMenuOpen = (root) => {
    const dropdown = root.querySelector('.header-user-menu__dropdown');
    return dropdown && !dropdown.hidden;
};

userMenuRoots.forEach((root) => {
    const toggle = root.querySelector('.header-user-menu__toggle');
    if (!toggle) {
        return;
    }
    toggle.addEventListener('click', (event) => {
        event.stopPropagation();
        if (isUserMenuOpen(root)) {
            closeUserMenu(root);
        } else {
            openUserMenu(root);
        }
    });
});

document.addEventListener('click', () => {
    userMenuRoots.forEach(closeUserMenu);
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        userMenuRoots.forEach(closeUserMenu);
    }
});

if (menuButton && nav && overlay) {
    menuButton.addEventListener('click', () => {
        nav.classList.add('nav--open');
        overlay.classList.add('overlay--visible');
        menuButton.classList.add('hidden');
    });
}

const closeNav = () => {
    if (nav) {
        nav.classList.remove('nav--open');
    }
    if (overlay) {
        overlay.classList.remove('overlay--visible');
    }
    if (menuButton) {
        menuButton.classList.remove('hidden');
    }
    userMenuRoots.forEach(closeUserMenu);
};

if (menuClose) {
    menuClose.addEventListener('click', closeNav);
}
if (overlay) {
    overlay.addEventListener('click', closeNav);
}
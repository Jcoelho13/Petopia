function openMenu(){
    const menu = document.getElementById('menu');

    menu.addEventListener('click', () => {
        const sideMenu = document.getElementById('side-menu');
        sideMenu.style.display = 'flex';
    });
}

function closeMenu(){
    const close = document.getElementById('menu2');

    close.addEventListener('click', () => {
        const sideMenu = document.getElementById('side-menu');
        sideMenu.style.display = 'none';
    });
}

function forceHiddenOnPageLoad(){
    const sideMenu = document.getElementById('side-menu');
    sideMenu.style.display = 'none';
}

openMenu();
closeMenu();
forceHiddenOnPageLoad();
window.addEventListener('DOMContentLoaded', () => {
    const menu_field = document.querySelector('.menu_field'),
        menu = document.querySelector('.menu'),
        menuElement = document.querySelectorAll('.menu_element'),
        hamburger_field = document.querySelector('.hamburger_field');
        hamburger = document.querySelector('.hamburger');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('hamburger_active');
        hamburger_field.classList.toggle('hamburger_field_active');
        menu.classList.toggle('menu_active');
        menu_field.classList.toggle('menu_field_active');
        if (document.body.style.overflow == 'hidden') {
            document.body.style.overflow = '';
        }
        else {
            document.body.style.overflow = 'hidden';
        }
    });

    menuElement.forEach(item => {
        item.addEventListener('click', () => {
            hamburger.classList.toggle('hamburger_active');
            hamburger_field.classList.toggle('hamburger_field_active');
            menu.classList.toggle('menu_active');
            menu_field.classList.toggle('menu_field_active');
        })
    });
})
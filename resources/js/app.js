import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.getElementById('mobile-menu-btn').addEventListener('click', function () {
    var mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden');
        this.setAttribute('aria-expanded', 'true');
    } else {
        mobileMenu.classList.add('hidden');
        this.setAttribute('aria-expanded', 'false');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    var dropdownButton = document.getElementById('tentang-kami-dropdown');
    var dropdownMenu = document.getElementById('tentang-kami-dropdown-menu');

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});

function showSection(sectionId) {
    document.getElementById('sejarahContent').style.display = 'none';
    document.getElementById('informasiContent').style.display = 'none';
    document.getElementById('legalitasContent').style.display = 'none';

    document.getElementById(sectionId + 'Content').style.display = 'block';
}
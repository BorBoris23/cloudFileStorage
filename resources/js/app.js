import './bootstrap';

import '../css/app.css';

import '../css/tailwind.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import './ajax';

import.meta.glob([
    '../images/**',
]);



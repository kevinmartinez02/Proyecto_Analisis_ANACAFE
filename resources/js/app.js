import './bootstrap';
import Alpine from 'alpinejs';
import toastr from 'toastr';
require('toastr');

window.Alpine = Alpine;

Alpine.start();
window.toastr = toastr;


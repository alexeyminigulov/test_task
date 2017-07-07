// import 'materialize-css/sass/materialize.scss';

require('./create')();

let datePicker = require('./datepicker');
datePicker();

require('./currency')();

require('./premium')();

require('./scrolled')();

$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

$(document).ready(function() {
    $('select').material_select();
});

var button = document.getElementById('add-employer'),
    btnEmpls = document.getElementById('list-employees');

function getHomeUrl() {
    return window.location.search;
}

button.addEventListener('click', addEmployer);
btnEmpls.addEventListener('click', backHome);

function addEmployer(e) {
    e.preventDefault();
    update_url('/create');
}

function backHome(e) {
    e.preventDefault();
    update_url();
}

function update_url(url) {

    document.body.scrollTop = 0;
    
    if(!url) {
        history.back();
    }
    history.pushState(null, null, url);
}
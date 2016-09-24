
/*
	Practica ValoRest: Pagina par la asignatura SW
    Copyright (C) 2016  
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

$(function() {

    var btn_movil = $('#nav-mobile'),
        menu = $('#menu').find('ul');

    btn_movil.on('click', function (e) {
        e.preventDefault();

        var el = $(this);

        el.toggleClass('nav-active');
        menu.toggleClass('open-menu');
    })

});

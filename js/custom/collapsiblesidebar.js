/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/** TUTORIAL: https://bootstrapious.com/p/bootstrap-sidebar **/
$(document).ready(function () {

    $('#sidebar').niceScroll({
        cursorcolor: '#53619d', // Changing the scrollbar color
        cursorwidth: 10, // Changing the scrollbar width
        cursorborder: 'none', // Rempving the scrollbar border
    });

//    $('#sidebarCollapse').on('click', function () {
//        $('#sidebar').toggleClass('active');
//    });
    $('.sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        
        // close dropdowns
        $('.collapse.in').toggleClass('in');
        // and also adjust aria-expanded attributes we use for the open/closed arrows
        // in our CSS
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

});
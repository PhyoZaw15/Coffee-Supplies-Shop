/** add active class and stay opened when selected */
var url = window.location.href.split('/', 5).join("/");
console.log(url);
// for sidebar menu entirely but not cover treeview
$('ul.nav-sidebar a').filter(function() {
    console.log(url.split('?', 1).join(""));
    return this.href == url.split('?', 1).join("");
}).addClass('active');

// for treeview
$('ul.nav-treeview a').filter(function() {
    return this.href == url.split('?', 1).join("");
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
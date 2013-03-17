$(document).ready(function() {
    // prepend a span element in front of each link
    $(".nav-tree a").parent().prepend("<span class=\"tree-item-type\"></span> ");

    // those span element being part of a parent element get a "+"
    $(".nav-tree ul:has(*)").parent().find("> .tree-item-type").text("+").toggleClass("tree-item-folder");

    // hide all submenus
    $(".nav-tree ul").hide();

    $(".tree-item-folder").click(function() {
        $(this).next().next().slideToggle("fast");
    })
});

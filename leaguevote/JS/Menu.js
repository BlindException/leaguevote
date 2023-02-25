var menu = $('#menu');
var menuBTN = $('#menuBTN');
var ruleBTN = $('#menuRulesBTN');
var userBTN = $('#menuUserBTN');
var groupBTN = $('#menuGroupBTN');
var rulesMenu = $('#rulesMenu')
var groupMenu = $('#groupsMenuUL');
var userMenu = $('#userMenu');
function loadMenu() {
    if (menu.is(':hidden') == false) {
        if (userMenu.is(':hidden') == false) {
            userMenu.slideToggle();
        }
        if (groupMenu.is(':hidden') == false) {
            groupMenu.slideToggle();
        }
        if (rulesMenu.is(':hidden') == false) {
            rulesMenu.slideToggle();
        }
            }
    menu.slideToggle();
}
userBTN.on('click', function () {
    if (groupMenu.is(':hidden') == false) {
        groupMenu.slideToggle();
    }
    if (rulesMenu.is(':hidden') == false) {
        rulesMenu.slideToggle();
    }
    userMenu.slideToggle();
});
groupBTN.on('click', function () {
    if (userMenu.is(':hidden') == false) {
        userMenu.slideToggle();
    }
    if (rulesMenu.is(':hidden') == false) {
        rulesMenu.slideToggle();
    }
    groupMenu.slideToggle();
});
ruleBTN.on('click', function () {
    if (groupMenu.is(':hidden') == false) {
        groupMenu.slideToggle();
    }
    if (userMenu.is(':hidden') == false) {
        userMenu.slideToggle();
    }
    rulesMenu.slideToggle();
});
$('#logout').on('click', function () {
    console.log("Log Out Fired");
    $.post('https://robertprockjr.com/leaguevote/controllers/index/logout.php', function () {
    })
        .done(function () {

            window.location.href = 'https://robertprockjr.com/leaguevote/';
        })
});
menu.focusout(function () {
    if (menu.is(':hidden') == false) {
        loadMenu();
    }
    else { return; }
});

    

$('html').on('keydown', function (event) {
    if (event.key == "Escape") {
        if (menu.is(':hidden') == false) {
            loadMenu();
        }
    }
});
    

    
    
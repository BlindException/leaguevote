function updateUser(){
let fName = $('#editFirstName').val();
let lName = $('#editLastName').val();
let email = $('#editEmail').val();
    $.post('https://robertprockjr.com/leaguevote/controllers/index/updateinfo.php', { FirstName: fName, LastName: lName, Email: email }, function (response) {
        console.log(response);
})
.done(function(){
$('#editUserCancelBTN').click();
});
}
function updatePassword(){
let password = $('#editUserPassword').val();
    $.post('https://robertprockjr.com/leaguevote/controllers/index/updatepassword.php', { Password: password }, function (response) {
        console.log(response);
})
.done(function(){
$('#editPasswordCancelBTN').click();
});
}
<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <title>leaguevote Log In</title>
    <style></style>
    <link href="https://robertprockjr.com/leaguevote/CSS/SiteStyle.css" rel="stylesheet" />
</head>
<body>
    <div class="container mx-auto mt-3 mb-5">
        <div class="row">
            <header class="bg-white p-3 my-5">
                <h1 class="w-25 p-5 mb-4 mt-3 ms-3 text-start rounded-circle">
                    LeagueVote
                </h1>
            </header>
        </div>
    </div>
    
    <div class="container mx-auto my-5">
        <main role="main">
            <div class="row">
                <h2 class="shadow mt-2 mb-4 rounded-pill text-center w-50 p-4 mx-auto border border-3">Login</h2>
                </div>
            <form class="needs-validation">
                <div class="row">
                    <label for="username" class="form-label">Enter Username:</label>
                </div>
                <div class="row">
                    <input type="text" id="username" name="Username" required onblur="checkUser()" class="form-control" /><div class="valid-feedback">&check;</div><div class="invalid-feedback">Enter a valid username.</div>
                </div>
                <div id="userMessage" style="display:none;">
                    <p class="p-3" m-3>No Username like this found.  </p><br /><p class="p-3 m-3">
                        Do you need to <a href="https://robertprockjr.com/leaguevote/views/users/create.html">create an account?</a>
                    </p>
                </div>




                <div class="row">
                    <label for="password" class="form-label">Enter Password:</label>
                </div>
                <div class=" row">
                    <input type="password" id="password" name="Password" required class="form-control" /><div class="valid-feedback">&check;</div><div class="invalid-feedback">Enter a valid password.</div>
                </div>
                <div class="row">
                    <label class="form-check-label">
                        Show Password<input type="checkbox" id="loginCB" class="form-check" />
                    </label>
                </div>
                <dialog id="dialogBox">
                    <div class="modal-dialog modal-dialog-centered">
                        Incorrect username or password, please try again. If you do not have an account, <a href='https://robertprockjr.com/leaguevote/views/users/create.html'>create one here.</a>
                    </div>
                </dialog>
                <div class="row">
                    <button id="loginSubmit" type="button" class="btn btn-success" onclick="login()">Login</button>
                </div>
                <div class="row">
                    <a class="p-3" href="https://robertprockjr.com/leaguevote/views/users/recoveraccount.html">Forgot Username Or Password?</a>
                </div>
            </form>
        </main>
    </div>
    
    
    
    <div class="container-fluid mt-5 mb-3">
        <footer class="bg-white text-center text-dark p-3 my-5 w-100">
            
            <div class="row">
                <small>&copy;2022 BlindException</small>
            </div>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-
3.4
.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
</body>
</html>
<script >
        function checkUser(){
        var username = $('#username').val();
        if (username == '') {
                                    return;
        }
        $.ajax({
            url: 'https://robertprockjr.com/leaguevote/Controllers/Index/CheckUser.php?q=' + username,
            beforeSend: function (xhr) {
                xhr.overrideMimeType("text/plain; charset=x-user-defined");
            }
        }, function(response) {
                console.log(response);
            })
            .done(function (data) {
                data = $.parseJSON(data);
                                                if (data < 1) {
let userMessage = $('#userMessage');
                                                    userMessage.show().focus();
                                                    userMessage.fadeOut(10000);
                }
            })
            .fail(function () {
                console.log("Database Not Available");
            })
    }
    var input = $('input');
    for (var i = 0; i < input.length; i++) {
        input[i].addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                $('#loginSubmit').click();
            }
        })
    }
    function login() {
        var username = $('#username').val();
        var password = $('#password').val();
        $.post('https://robertprockjr.com/leaguevote/controllers/index/login.php', { Username: username, Password: password }, function (response) {

            response = $.parseJSON(response);
            console.log(response);            
            if (response == 'invalid') {
                let dialog = $('#dialogBox');
                dialog.show().focus();
                                dialog.fadeOut(15000);
            } else if (response == 'valid') {
                window.location.href = "https://robertprockjr.com/leaguevote/views/index.php";
            }
        });          
    }   
    
        $('#loginCB').on('click', function () {
            if ($('#loginCB').is(':checked') == true) {
$('#password').prop('type', 'text');
                
            }
            if ($('#loginCB').is(':checked') == false) {
       $('#password').prop('type', 'password');
                                }
        })
    $(':reset').on('click', function () {
        $('#password').prop('type', 'password');
    });
    
        </script>
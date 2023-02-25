<?php
session_start();
try {
    require "../Controllers/Index/Index.php";
} catch (Error $e) {
    echo ($e);
}




?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>leaguevote</title>
    <link href="https://robertprockjr.com/leaguevote/CSS/SiteStyle.css" rel="stylesheet" />
</head>

<body>
    <button type="button" id="menuBTN" onclick="loadMenu()" class="btn btn-dark"><span
            class="material-symbols-outlined">
            menu
        </span></button>
    <div id="menuDiv">
        <?php include "../controllers/index/menu.php"; ?>
    </div>
    <div class="container mx-auto mt-3 mb-5">
        <div class="row">
            <header class="bg-white p-3 my-5">
                <h1 class="w-25 p-5 mb-4 mt-3 ms-3 text-start rounded-circle">LeagueVote
                </h1>
            </header>
        </div>
    </div>

    <div class="container mx-auto my-5">
        <main role="main">
            <section aria-labelledby="rulesTitle">
                <div class="row">
                    <h2 id="rulesTitle"
                        class="shadow mt-2 mb-4 rounded-pill text-center w-50 p-4 mx-auto border border-3">Rules</h2>
                    <br />
                </div>

                <div class="row">
                    <div class="container">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="openRules-tab" data-bs-toggle="tab"
                                    data-bs-target="#rulesTable" type="button" role="tab" aria-controls="openRules"
                                    aria-selected="true">Open</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="closedRule-tab" data-bs-toggle="tab"
                                    data-bs-target="#resultsTable" type="button" role="tab" aria-controls="closedRules"
                                    aria-selected="false">Closed</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="rulesTable" role="tabpanel"
                                aria-labelledby="openRules-tab"></div>
                            <div class="tab-pane fade" id="resultsTable" role="tabpanel"
                                aria-labelledby="closedRules-tab"></div>
                        </div>
                    </div>
                </div>


                <div class="container" id="newRuleBTNDiv">
                    <div class="row d-flex justify-content-center">
                        <button type='button' class='btn btn-primary' data-bs-toggle='modal'
                            data-bs-target='#createRuleModal'>Create Rule</button>
                    </div>
            </section>
        </main>
    </div>
    <!--Modals-->
    <?php require "../controllers/index/modals/usermodals/edituser.php";
    require "../controllers/index/modals/usermodals/ResetPassword.php";
    require "../controllers/index/modals/groupmodals/creategroup.php";
    require "../controllers/index/modals/groupmodals/groupinvite.php";
    require "../controllers/index/modals/groupmodals/editgroup.php";
    require "../controllers/index/modals/groupmodals/editmembers.php";
    require "../controllers/index/modals/groupmodals/editinvites.php";
    require "../controllers/index/modals/groupmodals/leavegroup.php";
    require "../controllers/index/modals/groupmodals/deletegroup.php";
    require "../controllers/index/modals/rulemodals/deleterule.php";
    require "../controllers/index/modals/rulemodals/createrule.php";
    ?>
    <div class="container-fluid mt-5 mb-3">
        <footer class="bg-white text-center text-dark p-3 my-5 w-100">

            <div class="row">
                <small>&copy;2022 BlindException</small>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-
3.4
.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="../JS/GroupSL.js"></script>
    <script src="../JS/RulesTable.js"></script>
    <script src="../JS/Groups.js"></script>
    <script src="../JS/Users.js"></script>
    <script src="../JS/Menu.js"></script>
    <script src="../JS/HTMLBuilders/SL_Builder.js"></script>
    <script src="../JS/Modals.js"></script>
    <script src="../JS/Rules.js"></script>
</body>

</html>
<script>
    $.ready(loadRules('all'), createRuleOptionBoxes(), loadResults(), loadGroupSLs(), loadCategorySLs(), displayGroups(), displayLeaveGroups(), function () {

    });
    $('#editPasswordCB').on('click', function () {
        if ($('#editPasswordCB').is(':checked') == true)
        {
            $('#editUserPassword').prop('type', 'text');
            $('#confirmEditUserPassword').prop('type', 'text');
            console.log('checked');
        }
        if ($('#editPasswordCB').is(':checked') == false)
        {
            $('#editUserPassword').prop('type', 'password');
            $('#confirmEditUserPassword').prop('type', 'password');
            console.log('not checked');
        }
    });
    function matchPassword() {
        var password = $('#editUserPassword').val();
        var confirm = $('#confirmEditUserPassword').val();
        if (confirm == '' && password == '')
        {
            return;
        }
        var submit = $('#resetPasswordModalSubmit');
        var message = $('#passwordMessage');
        message.hide();
        if (confirm === password)
        {
            submit.attr('disabled', false);
            message.hide();
        } else
        {
            submit.attr('disabled', true);
            message.show();
            message.focus();
            message.fadeOut(10000);
        }
    }
</script>
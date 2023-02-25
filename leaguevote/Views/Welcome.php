<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <title>Welcome To LeagueVote</title>
    <link href="https://robertprockjr.com/leaguevote/CSS/SiteStyle.css" rel="stylesheet" />
</head>

<body>
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
            <div class="row">
                <h2 class="shadow mt-2 mb-4 rounded-pill text-center w-50 p-4 mx-auto border border-3">Welcome</h2>
            </div>
            <div class="row">
                <div class="btn-group my-5 p-4">
                    <a class="btn btn-lg text-start rounded-end p-4 mt-3 mb-5"
                        style="background-color: #ff3c00; color: white;"
                        href="https://robertprockjr.com/leaguevote/views/login.php">Log into an Existing Account</a>
                    <a class="btn btn-lg text-start rounded-end p-4 mt-3 mb-5"
                        style="background-color: #ff3c00; color: white;"
                        href="https://robertprockjr.com/leaguevote/views/users/create.html">Create A New Account</a>

                </div>
            </div>
            <div class="row">
                <p>Welcome to LeagueVote. The site that allows you and your league mates to vote securely and without
                    politics.</p>
                <p>It's easy to get started:'</p>
                <ol>
                    <li>Create or log into an existing account.</li>
                    <li>Join a voting group. Either by creating a group or by invitation to an existing group.</li>
                    <li>Create a rule proposal, or vote on one created by someone in your league.</li>
                </ol>
                <p>Any member of a voting group can make a rule proposal.</p>
                <p>Creating a rule proposal takes only seconds.</p>
                <ol>
                    <li>Choose whether or not to enable majority rules. </li>
                    <ul style="list-style: disc;">
                        <li>If enabled, voting will close once a mathematical majority have voted. </li>
                        <li>If enabled, choose the number of days before majority rules go into effect.</li>
                        <li>Choose 0 days to enable majority rules immediately.</li>
                    </ul>
                    <li>Choose the voting Group for the rule proposal.</li>
                    <li>Choose the category for the rule proposal from:</li>
                    <ul style="list-style:disc;">
                        <li>Scoring - for any proposal to change the scoring in your league.</li>
                        <li>Roster - for any proposal to change the roster positions in your league.</li>
                        <li>Punishment - for any proposal related to the punishment in your league.</li>
                        <li>Other - for anything else you want to vote on.</li>
                    </ul>
                    <li>Give your proposal a title.</li>
                    <li>Provide details about what exactly you are proposing.</li>
                    <li>Select the number of options there will be to vote on.</li>
                    <li>Enter the voting options.</li>
                </ol>
                <p>That's it!</p>
                <p>Ready to get started?</p>

            </div>
            <div class="row">
                <div class="btn-group my-5 p-4">
                    <a class="btn btn-lg text-start rounded-end p-4 mt-3 mb-5"
                        style="background-color: #ff3c00; color: white;"
                        href="https://robertprockjr.com/leaguevote/views/login.php">Log into an Existing Account</a>
                    <a class="btn btn-lg text-start rounded-end p-4 mt-3 mb-5"
                        style="background-color: #ff3c00; color: white;"
                        href="https://robertprockjr.com/leaguevote/views/users/create.html">Create A New Account</a>

                </div>
            </div>
        </main>
    </div>
    <div class="container-fluid mt-5 mb-3">
        <footer class="bg-white text-center text-dark p-3 my-5 w-100">
            <div class="row">
                <span id="siteseal">
                    <script async type="text/javascript"
                        src="https://seal.godaddy.com/getSeal?sealID=AxmT5bRYSdaipFb55A0qlJON3WUnLKr8783mt4ggvFGqXKlkPF6PD4AZPv4a"></script>
                </span>
            </div>
            <div class="row">
                <small>&copy;2022 BlindException</small>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-
3.4
.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</body>

</html>
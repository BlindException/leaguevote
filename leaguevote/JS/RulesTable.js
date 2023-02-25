function loadRules(value)
{
    var rulesTable = $('#rulesTable');
    rulesTable.html('');
    if (value == '')
    {
        value = 'all';
    } else {
        value = value;
            }
    if(value == 'all') {
        rulesTable.load("https://robertprockjr.com/leaguevote/controllers/index/RulesTable.php?");
    } else {
        rulesTable.load("https://robertprockjr.com/leaguevote/controllers/index/onegrouprulestable.php?q=" + value);
    }
}
function showVote(id)
{
    console.log(id);
    var rule = $('#rule' + id);
    var optionBTN = $('#optionBTN' + id);
    optionBTN.removeAttr('onclick');
    optionBTN.attr('onclick', 'hideVote('+id+')');
    optionBTN.html('Cancel');
    rule.slideDown(1750);
}
function hideVote(id)
{
    console.log(id);
    var rule = $('#rule' + id);
    var optionBTN = $('#optionBTN' + id);
    optionBTN.removeAttr('onclick');
    optionBTN.attr('onclick', 'showVote('+id+')');
    optionBTN.html('Vote');
    rule.slideUp(1200);
}
function castVote(ruleID, userID, vote) {
    console.log(ruleID);
    console.log(userID);
    console.log(vote);
    $.ajax({
        url: 'https://robertprockjr.com/leaguevote/Controllers/index/castvote.php?rule=' + ruleID + '&user=' + userID + '&vote=' + vote,
        beforeSend: function (xhr) {
            xhr.overrideMimeType("text/plain; charset=x-user-defined");
        }
    })

        .done(function (data) { 
            $('#divForRule' + ruleID).fadeOut();
            loadRules('all');
            loadResults();
    })
        .fail(function () {
        })
}

function loadResults()
{
    var resultsTable = $('#resultsTable');
    resultsTable.empty();
    resultsTable.load("https://robertprockjr.com/leaguevote/controllers/index/ResultsTable.php");
}
$('#newRuleMajorityCheck').on('click', function () {
    if ($('#newRuleMajorityCheck').prop('checked') == true) {
        $('#newRuleDaysBeforeMajority').prop('disabled', false);
        $('#newRuleDaysBeforeMajority').prop('required', true);
        $('#newRuleDaysBeforeMajority').focus();
        $('#newRuleDaysBeforeMajority').val('');
    } else if ($('#newRuleMajorityCheck').prop('checked') == false) {
        $('#newRuleDaysBeforeMajority').prop('disabled', true);
        $('#newRuleDaysBeforeMajority').prop('required', false);
        $('#newRuleDaysBeforeMajority').val(999);
        $('#newRuleMajorityCheck').focus();
    }
});
function createRule() {
    
let ruleTitle= $('#newRuleTitle').val();
    let ruleDescription= $('#newRuleDescription').val();
    let groupForRule = $('#newRuleGroupSL').val();
    let categoryForRule = $('#newRuleCategorySL').val();
    let daysBeforeMajority = $('#newRuleDaysBeforeMajority').val();
    let numOfOptions = $('#newRuleNumOfOptions').val();
    let ruleOptions = [];
    var z = 1;
    for (var i = 0; i < numOfOptions; i++) {
        ruleOptions[i] = $('#newRuleOption' + z).val();
        console.log(ruleOptions[i]);
        z++;
    }
    let ruleMessage = $('#createRuleMessage')
    let cancelBTN = $('#newRuleCancelBTN');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/Rules.php', { Action: 'create', GroupID: groupForRule, CategoryID:categoryForRule, RuleTitle: ruleTitle, RuleDescription: ruleDescription, DaysBeforeMajority:daysBeforeMajority, NumOfOptions: numOfOptions, RuleOptions:ruleOptions}, function (){
            })
        .done(function() {
            ruleMessage.show().fadeOut(5000);
            setTimeout(function () {
                cancelBTN.click();
            }, 2000);           
                        loadRules('all');
       })
        .fail(function () {
            
                    })
}
function deleteRules() {
    var groupID = $('#deleteRuleGroupSL').val();
    var rules= [];
    $('.rule:checked').each(function () {

        var ruleID= this.id.slice(4);
        rules.push(ruleID);
        console.log(ruleID);

    })
    var ruleMessage = $('#deleteRuleMessage');
    var cancelBTN = $('#deleteRuleCancelBTN');
    var rulesTable = $('#deleteRulesTable');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/Rules.php', { Action: 'delete', GroupID: groupID, Rules: rules}, function (response) {
        console.log(response);
    })
        .done(function () {
            rulesTable.empty();
            displayRules();
            ruleMessage.show().fadeOut(5000);
            
            loadRules('all');
            loadResults();
        })
        .fail(function () {
            $('<p>There was a problem please try again later. If the problem persists, try logging out and back in.</p>').appendTo('#deleteRuleMessage');
        })
}

        
function displayRules() {
    let groupID = $('#deleteRuleGroupSL').val();
    console.log("fired");
    console.log(groupID);
    let rulesTable = $('#deleteRulesTable');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/Rules.php', {Action: 'rules', GroupID: groupID}, function (response) {
        console.log(response);
    })
        .done(function (data) {
            data = $.parseJSON(data);
            console.log(data.length);
            for (var i = 0; i < data.length; i++) {
                var rule = data[i];
                rule= $(rule);
                rule.appendTo(rulesTable);
            }
        })
}
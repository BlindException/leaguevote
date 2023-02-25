<?php
try {
    echo '
<div class="modal" id="createRuleModal" aria-hidden="true" tabindex="-1" aria-labelledby="newRule">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="newRule">New Rule</h4>
                        <button aria-label="close" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div><br />
<form class = "container needs-validation" method = "post" action = "https://robertprockjr.com/leaguevote/controllers/index/rules.php" id = "createRuleModalForm">
                    <div class="modal-body">

<input type = "text" value = "create" name = "Action" hidden/>
<div class = "row">Check this box to enable majority rules.</p></div>
<div class = "row"><ul>
<li>Select 0 days and majority rules will be effective immediately.</li>
<li>Select 1 day and majority rules will go into effect at midnight.</li>
<li>Select any number greater than 1 to enable majority rules after today. The first day will always bee the rest of the current day through midnight.</li></ul>
</div>
<div class = "row"><label for = "newRuleMajorityCheck" class = "form-check-label">Enable Majority Rules</label></div>
<div class = "row"><input type = "checkbox" id = "newRuleMajorityCheck"  class = "form-check-input"></div>
<div class = "row"><label for = "newRuleDaysBeforeMajority" class = "form-label">Majority rules will go into effect after <input type = "number" step = "1" id = "newRuleDaysBeforeMajority" name = "CreateDaysBeforeMajority" disabled class = "form-control"/><div class="valid-feedback">&check;</div><div class="invalid-feedback">Enter a valid number of days.</div> days</label></div>

<div class = "row"><label for = "newRuleGroupSL">Select Group</label></div>
<div class = "row"><select id = "newRuleGroupSL" class = "form-select-lg groupSL" name = "CreateRuleGroupID" required></select><div class="valid-feedback">&check;</div><div class="invalid-feedback">Select a group name.</div></div>

<div class = "row"><label for = "newRuleCategorySL" required>Select a Category For Your Rule:</label></div>
<div class = "row"><select id = "newRuleCategorySL" class = "form-select-lg categorySL" required name = "CreateRuleCategoryID"></select><div class="valid-feedback">&check;</div><div class="invalid-feedback">Select a category name.</div></div>
                    <div class = "row"><label for="newRuleTitle" class = "form-label">Rule Title:</label></div>
                    <div class = "row"><input type="text" id="newRuleTitle" title="Enter A Title For The Rule" class = "form-control" name = "CreateRuleTitle" required/><div class="valid-feedback">&check;</div><div class="invalid-feedback">Enter a valid rule title.</div></div>
                    <div class = "row"><label for="newRuleDescription" class = "form-label">Description</label></div>
<div class = "row"><textarea id="newRuleDescription" title="Enter All The Details For The Rule" rows = "4" required class = "form-control" name = "CreateRuleDescription"></textarea><div class="valid-feedback">&check;</div><div class="invalid-feedback">Enter a valid rule description.</div></div>
<hr>
<div class = "row"><h4  class = "modal-title">newRule Options</h4></div>
<div class = "row"><p>The word(s) or phrase(s) you enter here will appear as the options available to vote on. You must have a minimum of2 options and as many as 10 for any rule.</p></div>
<div class = "row"><label for = "newRuleNumOfOptions" class = "form-label">How many options does your rule need?</label></div>
<div class = "row"><select id = "newRuleNumOfOptions"  onchange = "createRuleOptionBoxes()" required class = "form-select" name= "CreateNumOfOptions">
<option value = "2" selected>2</option>';
    for ($i = 3; $i <= 10; $i++) {
        echo '<option value ="' . $i . '">' . $i . '</option>';
    }
    echo '</select><div class="valid-feedback">&check;</div><div class="invalid-feedback">Select a number of options for your rule.</div></div>';
    echo '<div id = "newRuleOptionDIV" class = "container"></div>

</div>
<div class="modal-footer">
<div class = "row" style = "display:none;" id = "createRuleModalAYS"><h6 >Are You Sure?</h6></div>
                    <button id = "createRuleModalCancel" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button id="createRuleModalSubmit" type="button" class = "btn btn-success" onclick = "areYouSure(\'createRuleModal\')">Create Rule</button>
<button id="createRuleModalNo" style = "display:none;" type="button" class = "btn btn-danger-lg" onclick = "doNotSubmit(\'createRuleModal\')">No</button>
<button id="createRuleModalYes" style = "display:none;"  type="button" class = "btn btn-success-lg" onclick = "doSubmit(\'createRuleModal\')">Yes</button>
                    </div>
                    </form>
                </div>
            </div>
</div>';
} catch (Error $e) {
    echo ($e->getMessage());
}
?>
<?php
try {
    echo '
<div class="modal" id="deleteARuleModal" aria-hidden="true" tabindex="-1" aria-labelledby="deleteRuleHeader">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteRuleHeader">Delete Rule</h4>
                        <button aria-label="close" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div><br />
                    <form class = "container needs-validation" method = "post" action = "https://robertprockjr.com/leaguevote/controllers/index/rules.php" id = "deleteARuleModalForm">
<div class="modal-body">

<input type = "text" value = "delete" name = "Action" hidden/>
<div class = "row"><label for = "deleteRuleGroupSL">Select a Group</label></div>
<div class = "row"><select id = "deleteRuleGroupSL" class = "form-select-lg groupSL" onchange = "displayRules()" name = "DeleteRuleGroupID" required></select><div class="valid-feedback">&check;</div><div class="invalid-feedback">Select a group.</div></div>
<div class = "container"><div id = "deleteRulesTable"></div></div>

</div>
<div class="modal-footer">
<div class = "row" style = "display:none;" id = "deleteARuleModalAYS"><h6 >Are You Sure?</h6></div>
                    <button id = "deleteARuleModalCancel" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button id="deleteARuleModalSubmit" type="button" class = "btn btn-success" onclick = "areYouSure(\'deleteARuleModal\')">Delete Rule(s)</button>
<button id="deleteARuleModalNo" style = "display:none;" type="button" class = "btn btn-danger-lg" onclick = "doNotSubmit(\'deleteARuleModal\')">No</button>
<button id="deleteARuleModalYes" style = "display:none;"  type="button" class = "btn btn-success-lg" onclick = "doSubmit(\'deleteARuleModal\')">Yes</button>
                    </div>
                    </form>
                </div>
            </div>
</div>';
} catch (Error $e) {
    echo ($e->getMessage());
}
?>
<?php
echo "
<div class='modal' id='editGroupModal' aria-hidden='true' tabindex='-1' aria-labelledby='editGroup'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='editGroup'>Edit Group</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'editGroupModalForm'>
                <!-- Modal body -->

                <div class='modal-body'>

<input type = 'text' value = 'edit' name = 'Action' hidden/>
<div class = 'row'><label for = 'editGroupSL' class = 'form-label'>Select Name of Group:</label></div>
<div class = 'row'><select id = 'editGroupSL' class = 'form-select-lg createdGroupSL' onchange = 'loadGroupDataForEdit()' required required name = 'EditGroupID'></select><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>Select a Group to edit!</div></div>
<div class = 'row'><label for = 'editGroupName' class = 'form-label'>Edit Group Name:</label></div>
<div class = 'row'><input type = 'text' id = 'editGroupName' required class = 'form-control' name = 'EditGroupName'><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>Enter Valid Group Name!</div></div>
<div class = 'row'><label for = 'editGroupSize' class = 'form-label'>Maximum Number of Members:</label></div>
<div class = 'row'><input type = 'number' step ='1' min = '2' id = 'editGroupSize' class = 'form-control' required name = 'EditGroupSize'/><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>Enter Valid Group size!</div></div>

                                                        </div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                    <div class = 'row' style = 'display:none;' id = 'editGroupModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'editGroupModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='editGroupModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"editGroupModal\")'>Edit Group</button>
<button id='editGroupModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"editGroupModal\")'>No</button>
<button id='editGroupModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"editGroupModal\")'>Yes</button>
                </div>
</form>
            </div>
        </div>


        </div></div>
";
?>
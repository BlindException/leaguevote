<?php
echo "
<div class='modal' id='createGroupModal' aria-hidden='true' tabindex='-1' aria-labelledby='createGroup'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='createGroup'>Create Group</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'createGroupModalForm' name = 'createGroupModalForm>
                <!-- Modal body -->

                <div class='modal-body'>

<input type = 'text' value = 'create' name = 'Action' hidden/>
<div class = 'row'><label for = 'newGroupName' class = 'form-label'>Enter Name of Group:</label></div>
<div class = 'row'><input type = 'text' id = 'newGroupName' name = 'NewGroupName' class = 'form-control' required/><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>Enter Valid Group Name!</div></div>
<div class = 'row'><label for = 'newGroupSize' class = 'form-label'>Maximum Number of Members:</label></div>
<div class = 'row'><input type = 'number' step ='1' min = '2' id = 'newGroupSize' name = 'NewGroupSize' class = 'form-control' value = '' required /><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>Enter Valid number of members! It must be at least 2.</div></div>

                                                        </div>

                <!-- Modal footer -->
                <div class='modal-footer'>
<div class = 'row' style = 'display:none;' id = 'createGroupModalAYS' ><h6 > Are You Sure?</h6></div>
                    <button id = 'createGroupModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal' value = 'Cancel'>Cancel</button>
                    <button id='createGroupModalSubmit' type='button' class = 'btn btn-success' value = 'Create Group' onclick = 'areYouSure(\"createGroupModal\")'>CREATE GROUP</button>
<button id='createGroupModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' value = 'no' onclick = 'doNotSubmit(\"createGroupModal\")'>No</button>
<button id='createGroupModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' value = 'yes' onclick = 'doSubmit(\"createGroupModal\")'>Yes</button>
                </div>
</form>
            </div>
        </div>


        </div></div>
";
?>
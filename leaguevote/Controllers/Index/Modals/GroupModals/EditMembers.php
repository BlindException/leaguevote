<?php
echo "
<div class='modal' id='editMembersModal' aria-hidden='true' tabindex='-1' aria-labelledby='editMembers'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='editMembers'>Remove Members of Your Group:</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'editMembersModalForm'>
                <!-- Modal body -->

                <div class='modal-body'>

<input type = 'text' value = 'deleteMembers' name = 'Action' hidden/>
<div class = 'row'><label for = 'editMemberGroupSL' class = 'form-label'>Select Name of Group:</label></div>
<div class = 'row'><select id = 'editMemberGroupSL' onchange= 'displayMembers()' class = 'form-select-lg createdGroupSL' required name = 'DeleteMembersGroupID'></select></div>
<div class = 'row'><div class = 'container' id = 'membersTable'></div></div>

</div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                    <div class = 'row' style = 'display:none;' id = 'editMembersModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'editMembersModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='editMembersModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"editMembersModal\")'>Delete Members</button>
<button id='editMembersModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"editMembersModal\")'>No</button>
<button id='editMembersModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"editMembersModal\")'>Yes</button>
                </div>
</form>

            </div>
        </div>


        </div></div>
";
?>
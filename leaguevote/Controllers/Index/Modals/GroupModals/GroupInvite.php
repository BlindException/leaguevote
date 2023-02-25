<?php
echo "
<div class='modal' id='groupInviteModal' aria-hidden='true' tabindex='-1' aria-labelledby='groupInvite'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='groupInvite'>Send Invitation(s) to Your Group</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'groupInviteModalForm'>
                <!-- Modal body -->

                <div class='modal-body'>

<input type = 'text' value = 'invite' name = 'Action' hidden/>
<div class = 'row'><label for = 'groupInviteSL' class = 'form-label'>Select Name of Group:</label></div>
<div class = 'row'><select id = 'groupInviteSL' class = 'form-select-lg createdGroupSL' onclick = 'makeRecipientBoxes()' required name = 'InviteGroupID'></select></div>
                    <div class = 'row'><div id = 'groupInviteDIV'></div></div>

                                                                    </div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                                        <div class = 'row' style = 'display:none;' id = 'groupInviteModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'groupInviteModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='groupInviteModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"groupInviteModal\")'>Send Invite(s)</button>
<button id='groupInviteModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"groupInviteModal\")'>No</button>
<button id='groupInviteModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"groupInviteModal\")'>Yes</button>
                </div>
</form>

            </div>
        </div>


        </div></div>
";
?>
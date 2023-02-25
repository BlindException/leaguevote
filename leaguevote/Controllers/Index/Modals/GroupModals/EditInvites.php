<?php
echo "
<div class='modal' id='editInvitesModal' aria-hidden='true' tabindex='-1' aria-labelledby='editInvites'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='editInvites'>Delete Invitations For Your Group:</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'editInvitesModalForm'>
                <!-- Modal body -->

                <div class='modal-body'>

<input type = 'text' value = 'deleteInvites' name = 'Action' hidden/>
<div class = 'row'><label for = 'editInviteGroupSL' class = 'form-label'>Select Name of Group:</label></div>
<div class = 'row'><select id = 'editInviteGroupSL' onchange= 'displayInvites()' class = 'form-select-lg createdGroupSL' required name = 'DeleteInvitesGroupID'></select></div>
<div class = 'row'><div class = 'container' id = 'invitesTable'></div>
                                                        </div>

</div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                                        <div class = 'row' style = 'display:none;' id = 'editInvitesModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'editInvitesModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='editInvitesModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"editInvitesModal\")'>Delete Invites</button>
<button id='editInvitesModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"editInvitesModal\")'>No</button>
<button id='editInvitesModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"editInvitesModal\")'>Yes</button>
                </div>
</form>

            </div>
        </div>


        </div></div>
";
?>
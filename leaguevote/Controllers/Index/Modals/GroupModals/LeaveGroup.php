<?php
echo "
<div class='modal' id='leaveGroupModal' aria-hidden='true' tabindex='-1' aria-labelledby='leaveGroup'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='leaveGroup'>Leave Group</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'leaveGroupModalForm'>
                <!-- Modal body -->
                <div class='modal-body'>

<input type = 'text' value = 'leave' name = 'Action' hidden/>
<div class = 'row'><div class = 'container' id = 'leaveGroupsTable'></div>


                                                        </div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                    <div class = 'row' style = 'display:none;' id = 'leaveGroupModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'leaveGroupModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='leaveGroupModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"leaveGroupModal\")'>Leave Group</button>
<button id='leaveGroupModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"leaveGroupModal\")'>No</button>
<button id='leaveGroupModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"leaveGroupModal\")'>Yes</button>
                </div>
</form>
            </div>
        </div>


        </div></div>
";
?>
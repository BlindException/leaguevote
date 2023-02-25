<?php
echo "
<div class='modal' id='deleteGroupModal' aria-hidden='true' tabindex='-1' aria-labelledby='deleteGroup'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='deleteGroup'>Delete Group</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/groups.php' id = 'deleteGroupModalForm'>
                <!-- Modal body -->
                <div class='modal-body'>

<input type = 'text' value = 'delete' name = 'Action' hidden/>
<div class = 'row'><div class = 'container' id = 'groupsTable'></div>

                                                        </div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                    <div class = 'row' style = 'display:none;' id = 'deleteGroupModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'deleteGroupModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='deleteGroupModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"deleteGroupModal\")'>Delete Group(s)</button>
<button id='deleteGroupModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"deleteGroupModal\")'>No</button>
<button id='deleteGroupModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"deleteGroupModal\")'>Yes</button>
                </div>
</form>
            </div>
        </div>


        </div></div>
";
?>
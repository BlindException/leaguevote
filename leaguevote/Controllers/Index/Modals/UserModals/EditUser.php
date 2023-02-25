<?php
echo "
<div class='modal' id='editUserModal' aria-hidden='true' tabindex='-1' aria-labelledby='editUser'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='editUser'>Edit User</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/updateinfo.php' id = 'editUserModalForm'>
                <!-- Modal body -->

                <div class='modal-body'>

<input type = 'text' value = 'edit' name = 'Action' hidden/>
                    <div class = 'row'><label for='editFirstName' class = 'form-label'>First name:</label></div>
                    <div class = 'row'><input type='text' id='editFirstName' required value='$user->First' class = 'form-control' name = 'EditFirstName' min = '2'/><div class='valid-feedback'>&check;</div><div class='invalid-feedback'>Enter a valid first name.</div></div>
                    <div class = 'row'><label for='editLastName' class = 'form-label'>Last Name:</label></div>
                    <div class = 'row'><input type='text' id='editLastName' name = 'EditLastName' min = '2'required value='$user->Last' class = 'form-control'/><div class='valid-feedback'>&check;</div><div class='invalid-feedback'>Enter a valid last name.</div></div>
                    <div class = 'row'><label for='editEmail' class = 'form-label'>Email:</label></div>
                    <div class = 'row'><input type='email' id = 'editEmail' name='EditEmail' required value='$user->Email' class = 'form-control'/><div class='valid-feedback'>&check;</div><div class='invalid-feedback'>Enter a valid email.</div></div>

</div>

                <!-- Modal footer -->
                <div class='modal-footer'>
                    <div class = 'row' style = 'display:none;' id = 'editUserModalAYS'><h6 >Are You Sure?</h6></div>
                    <button id = 'editUserModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='editUserModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"editUserModal\")'>Edit User Info</button>
<button id='editUserModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"editUserModal\")'>No</button>
<button id='editUserModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg'  onclick = 'doSubmit(\"editUserModal\")'>Yes</button>
                </div>
</form>
            </div>
        </div>


        </div></div>
";
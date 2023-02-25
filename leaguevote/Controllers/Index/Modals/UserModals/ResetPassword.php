<?php

echo "
<div class='modal' id='resetPasswordModal' aria-hidden='true' tabindex='-1' aria-labelledby='resetPassword'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title' id='resetPassword'>Reset Password</h4>
                    <button aria-label='close' type='button' class='btn-close' data-bs-dismiss='modal'></button>
                </div><br />
<form class = 'container needs-validation' method = 'post' action = 'https://robertprockjr.com/leaguevote/controllers/index/updatepassword.php' id = 'resetPasswordModalForm'>
                <!-- Modal body -->
                <div class='modal-body'>

<input type = 'text' value = 'resetInApp' name = 'Action' hidden/>
<div class = 'row'><label for='editUserPassword' class = form-label'>Enter New Password:</label></div>
            <div class = 'row'><input type='password' id='editUserPassword' name='EditUserPassword' required onblur='matchPassword()' class = 'form-control' pattern='(?=^.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}$' title='Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' /><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>╘Enter Valid Password! It must be at least 8 characters, contain 1 uppercase letter, 1 lowercase letter and 1 number.</div></div>

<div class = 'row'><label for='confirmEditUserPassword' class = 'form-label'>Confirm Password:</label></div>
            <div class = 'row'><input type='password' id='confirmEditUserPassword' required onblur='matchPassword()'  class = 'form-control' pattern='(?=^.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}$' title='Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' /><div class = 'valid-feedback'>&check;</div><div class = 'invalid-feedback'>╘Enter Valid Password! It must be at least 8 characters, contain 1 uppercase letter, 1 lowercase letter and 1 number.</div></div>


<div class = 'row'><label class = 'form-check-label'>Show Password<input type = 'checkbox' id = 'editPasswordCB'/></label></div>

                                                        </div>

                <!-- Modal footer -->
                <div class='modal-footer'>
<div class = 'row' style = 'display:none;' id = 'resetPasswordModalAYS'><h6 >Are You Sure?</h6></div>
<div class = 'row'><p id = 'passwordMessage'>Your passwords do not match!</p></div>
                    <button id = 'resetPasswordModalCancel' type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                    <button id='resetPasswordModalSubmit' type='button' class = 'btn btn-success' onclick = 'areYouSure(\"resetPasswordModal\")'>Reset Password</button>
<button id='resetPasswordModalNo' style = 'display:none;' type='button' class = 'btn btn-danger-lg' onclick = 'doNotSubmit(\"resetPasswordModal\")'>No</button>
<button id='resetPasswordModalYes' style = 'display:none;'  type='button' class = 'btn btn-success-lg' onclick = 'doSubmit(\"resetPasswordModal\")'>Yes</button>
                </div>
</form>
            </div>
        </div>


        </div></div>
";
<?php
echo "<nav id = 'menu' style = 'display:none;' >
<ul>
<li><button type = 'button' id = 'menuUserBTN' class = 'btn btn-secondary border border-dark border-2'>User</button></li>
<ul id = 'userMenu' style = 'display:none;'>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#editUserModal' id='editUserModalBTN'>Edit Name & Email</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#resetPasswordModal' id='resetPasswordBTN'>Reset Password</button></li>
</ul>
<li><button type = 'button'  id = 'menuGroupBTN' class = 'btn btn-secondary border border-dark border-2'>Groups</button></li>
<ul id = 'groupsMenuUL' style = 'display:none;'>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#createGroupModal' id='createGroupBTN'>Create a New Group</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#groupInviteModal' id='groupInviteBTN'>Send Invitation To Your Group</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#editInvitesModal' id='editInvitesBTN'>Manage Invitations You Sent</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#editGroupModal' id='editGroupBTN'>Edit Details For Group You Created</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#editMembersModal' id='editMembersBTN'>Manage Members of a Group You Created</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2'' data-bs-toggle='modal' data-bs-target='#leaveGroupModal' id='leaveGroupBTN'>Leave A Group You Belong To</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#deleteGroupModal' id='deleteGroupBTN'>Delete a Group You Created</button></li>
</ul>
<li><button type = 'button' id = 'menuRulesBTN' class = 'btn btn-secondary border border-dark border-2'>Rules</button></li>
<ul id = 'rulesMenu' style = 'display:none;'>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#deleteARuleModal' id='deleteRuleBTN'>Delete a Rule you Created</button></li>
<li><button type='button' class = 'btn btn-secondary border border-dark border-2' data-bs-toggle='modal' data-bs-target='#createRuleModal' id='createRuleMenuBTN'>Create a New Rule</button></li>

</ul>
<li><button id = 'logout' type = 'button'  class = btn btn-danger'>Log Out</button></li>
</ul>
</nav>
";
//}
?>
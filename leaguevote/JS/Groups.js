function createGroup(modalID) {
    areYouSure(modalID);
    
    /*if (checkResponse(modalID) == 'no' || checkResponse(modalID)== null || checkResponse(modalID) == '') {
        return;
    } else if (checkResponse(modalID) == 'yes') {
                    let groupName = $('#newGroupName').val();
    let groupSize = $('#newGroupSize').val();
    
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'create', GroupName: groupName, GroupSize: groupSize}, function (response) {
        console.log(response);
    })
    .done(function() {
        loadGroupSLs();
        $('#createGroupCancelBTN').click();

    })
}*/
    
}
function editGroup() {
    let groupName = $('#editGroupName').val();
    let groupSize = $('#editGroupSize').val();
    
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'edit', GroupName: groupName, GroupSize: groupSize}, function (response) {
        console.log(response);
    })
    .done(function () {
        loadGroupSLs();
        $('#editGroupCancelBTN').click();
            })
}
function sendInvite(){
    let groupID = $('#groupInviteSL').val();
    
    let recipients = [];
    $('.recipient').each(function () {
        if (this.value!= '') {
            recipients.push(this.value);
            console.log(this.value);
        }
    })    

    
                $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', {Action: 'invite', GroupID: groupID, Recipients: recipients}, function () {
                })
                    .done(function () {
                        $('#groupInviteCancelBTN').click();
                    })
                    .fail(function () {
                        console.log('No new members');
                    });
}
function deleteGroup() {
    let groupID= $('#deleteGroupSL').val();
     
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', {Action: 'delete', GroupID: groupID}, function (response) {
        console.log(response);
    })
        .done(function () {
            loadGroupSLs();
            $('#deleteGroupCancel').click();
        })
}

function leaveGroup() {
    let groupID = $('#leaveGroupSL').val();
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'leave', GroupID: groupID }, function (response, status) {
        console.log(response);
        console.log(status);
    })
        .done(function () {
            loadGroupSLs();
            loadRules('all');
            loadResults();
            $('#leaveGroupCancelBTN').click();
                                })
}
function displayMembers() {
    let groupID = $('#editMemberGroupSL').val();
    console.log("fired");
    let membersTable = $('#membersTable');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'members', GroupID: groupID }, function (response) {
        console.log(response);
    })
        .done(function (data) {
            data = $.parseJSON(data);
            for (var i = 0; i < data.length; i++) {
                var member = data[i];
                member = $(member);
                member.appendTo(membersTable);
            }
        })
}
function displayInvites() {
    let groupID = $('#editInviteGroupSL').val();
    console.log("fired");
    let invitesTable= $('#invitesTable');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'invites', GroupID: groupID }, function (response) {
        console.log(response);
    })
        .done(function (data) {
            data = $.parseJSON(data);
            for (var i = 0; i < data.length; i++) {
                var invite = data[i];
                invite= $(invite);
                invite.appendTo(invitesTable);
            }
        })
}
function makeRecipientBoxes() {
    let groupID = $('#groupInviteSL').val();
    console.log(groupID);
    let groupInviteDiv = $('#groupInviteDIV');
    groupInviteDiv.empty();
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'count', GroupID: groupID }, function () {
            })
        .done(function (data) {
            data = $.parseJSON(data);
                        let numOfBoxes = data;
            console.log("Number of Boxes: " + numOfBoxes);

            
                   
                let z = 1;
                for (var i = 0; i < numOfBoxes; i++) {
                    let label = $('<label for = "recipient' + z + '" class = "form-label">Enter Email '+z+':</label>');
                    let input = $('<input type = "email" id = "recipient' + z + '" name = "Recipients[]" class = "form-control recipient" />');
                    label.appendTo(groupInviteDiv);
                    input.appendTo(groupInviteDiv);
                    z++;
                }
                    })
}
function deleteInvites() {
    var groupID = $('#editInviteGroupSL').val();
    var invites = [];
    $('.invites:checked').each(function () {

        var inviteID = this.id.slice(6);
        invites.push(inviteID);
        console.log(inviteID);

    })
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'deleteInvites', GroupID: groupID, Invites: invites}, function (response) {
        console.log(response);
    })
        .done(function () {
            var invitesTable = $('#invitesTable');
            invitesTable.empty();
            displayInvites();
                    })
}
function deleteMembers() {
    var groupID = $('#editMemberGroupSL').val();
    var members = [];
    $('.member:checked').each(function () {
        
            var memberID = this.id.slice(6);
            members.push(memberID);
            console.log(memberID);

            })
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'deleteMembers', GroupID: groupID, Members: members}, function (response) {
        console.log(response);
    })
        .done(function () {
            let membersTable = $('#membersTable');
            membersTable.empty();
            displayMembers();
                    })
}
function loadGroupDataForEdit() {
    let groupID = $('#editGroupSL').val();
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'loadEdit', GroupID: groupID }, function () {
    })
        .done(function (data) {
            data = $.parseJSON(data);
            console.log(data.length);
            $('#editGroupSize').val(data[1]);
            $('#editGroupName').val(data[0]);
        })
}
function displayGroups() {
   

    let groupsTable = $('#groupsTable');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'groups'}, function (response) {
        console.log(response);
    })
        .done(function (data) {
            data = $.parseJSON(data);
            for (var i = 0; i < data.length; i++) {
                var group = data[i];
                group = $(group);
                group.appendTo(groupsTable);
            }
        })
}
function displayLeaveGroups() {
    let groupsTable = $('#leaveGroupsTable');
    $.post('https://robertprockjr.com/leaguevote/controllers/index/groups.php', { Action: 'leaveGroups' }, function (response) {
        console.log(response);
    })
        .done(function (data) {
            data = $.parseJSON(data);
            for (var i = 0; i < data.length; i++) {
                if (data.length > 0) {
                    var group = data[i];
                    group = $(group);
                    group.appendTo(groupsTable);
                } else if (data.length === 0) {
                    $('<div class = "row"><p>No Groups to display. You cannot leave a Group if your are the creator. Please delete the Group instead.</p>').appendTo(groupsTable);
                }
                            }
        })
}
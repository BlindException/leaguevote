        function createRuleOptionBoxes() {
    var ruleOptions = $('#newRuleOptionDIV');
    var numberOfOptions = $('#newRuleNumOfOptions').val();
    console.log(numberOfOptions);
    ruleOptions.empty();
    for (var i = 1; i <= numberOfOptions; i++) {
        var id = "newRuleOption" + i;
        console.log(id);
        var label = $('<label for = "' + id + '">Option ' + i + ':</label>');
        
        var input = $('<input type = "text" id = "' + id + '" class = "form-control" required name = "CreateRuleOptions[]">');
        label.appendTo(ruleOptions);
        input.appendTo(ruleOptions);
        }    
}
// On Modal Submit Button
function areYouSure(modalID) {
    console.log("fired are you sure");
    console.log(modalID);
    var form = $('#' + modalID + 'Form');
    var cancel = $('#' + modalID + 'Cancel');
    var submit = $('#' + modalID + 'Submit');
    var no = $('#' + modalID + 'No');
    var yes = $('#' + modalID + 'Yes');
    var message = $('#' + modalID + 'AYS');
    message.show();
    no.show().focus();
    yes.show();
    cancel.hide();
    submit.hide();
    var formInputs = $('input, select, textarea');
    formInputs.each(function () {
        var formInput = $(this);
formInput.prop('readonly', true);
    });
    }

// On "No" Button
function doNotSubmit(modalID) {
    var form = $('#' + modalID + 'Form');
    var cancel = $('#' + modalID + 'Cancel');
    var submit = $('#' + modalID + 'Submit');
    var no = $('#' + modalID + 'No');
    var yes = $('#' + modalID + 'Yes');
    var message = $('#' + modalID + 'AYS');
    var formInputs = $('input, select, textarea');
    formInputs.each(function () {
        var formInput = $(this);
        formInput.prop('readonly', false);
    });
    message.hide();
    no.hide();
    yes.hide();
    cancel.show().focus();
    submit.show();
}
function doSubmit(modalID) {
    var form = $('#' + modalID + 'Form');
    var cancel = $('#' + modalID + 'Cancel');
    var submit = $('#' + modalID + 'Submit');
    var no = $('#' + modalID + 'No');
    var yes = $('#' + modalID + 'Yes');
    var message = $('#' + modalID + 'AYS');
        var invalid = 0;
    var requiredInputs = $('#' + modalID + 'Form input, #' + modalID + 'Form select, #' +modalID + 'Form textarea');
    var required = 0;
    
        

    
    var invalidInputs = [];
    requiredInputs.each(function () {
        let inputID = $(this).id;
        let thisLabel = $("label[for ='" + $(inputID) + "']");
        if ($(this).is(':required') && $(this).val() == '') {
            $(this).addClass("invalidInput");
            thisLabel.addClass("invalidLabel");
            invalid++;
            invalidInputs.push($(this));
        } else if ($(this).attr('class', 'invalidInput')) {
            $(this).removeClass("invalidInput");
            thisLabel.removeClass("invalidLabel");
            $(this).addClass("validInput");
            thisLabel.addClass("validLabel");
        } else {
            $(this).addClass("validInput");
            thisLabel.addClass("validLabel");
        }
    })
    
    console.log(invalid);
    if (invalid > 0) {
        no.click();
        $(invalidInputs[0]).focus();
        alert("This field is invalid, please correct before you can submit.");
    } else if (invalid === 0) {
        form.submit();
    }
    }
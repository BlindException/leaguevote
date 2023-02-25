function buildMySL(thisID, table) {
    
    let thisSL = $('#' + thisID);
    let thisSLID = thisSL.val();
    let slTable= table;
    
    $.get('https://robertprockjr.com/leaguevote/controllers/index/htmlbuilders/sl_options.php?Table=' + slTable, function () {
    })
        .done(function (data) {
            thisSL.empty();
            data = $.parseJSON(data);
            for (var i = 0; i < data.length; i++) {
                var text = data[i];
                var slOption = $(text);
                slOption.appendTo(thisSL);
            }
        })
        .fail(function (data) {
                                })
}
function buildCreatedRuleSL(thisElement) {
    console.log("it fired!");
    console.log(thisElement.id);
    let groupSL = thisElement.id;
    groupSL = $('#' + groupSL);
        var groupID = groupSL.val();
    console.log(groupID);
    let ruleSL = $('#deleteRuleTitle');
    ruleSL.empty();
    $.get('https://robertprockjr.com/leaguevote/controllers/index/htmlbuilders/sl_options.php?Table=CreatedRules&GroupID='+groupID, function(){
            })
        .done(function (data) {
                        console.log(data.length);
            data = $.parseJSON(data); 
            console.log(data.length);
            if (data.length == 1) {
                var option = "<option>Nothing to see here</option>"
                option = $(option);
                option.appendTo(ruleSL);
            }
            else if (data.length > 1) {
                for (var i = 0; i < data.length; i++) {
                    console.log(data[i]);
                    var text = data[i];
                    var slOption = $(text);

                    slOption.appendTo(ruleSL);





                }
            }
        })
        .fail(function () {
            console.log("Failure");
        })

}
function loadCategorySLs() {
    $('.categorySL').each(function () {
        if (this.id == '') {
            return;
        }
        buildMySL(this.id, 'Categories');
    });
}
function loadGroupSLs() {
    $('.groupSL').each(function () {
        if (this.id == '') {
            return;
        }
        buildMySL(this.id, 'Groups');


    });
    $('.createdGroupSL').each(function () {
        if (this.id == '') {
            return;
        }
        buildMySL(this.id, 'createdGroups');


    });
}
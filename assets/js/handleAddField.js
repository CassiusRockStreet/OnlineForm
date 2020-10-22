$('document').ready(function(){
    var ExtraFields = [];
    var iterate = 0;
    const addFields = $('.AddFields');

    $('#addCustomField').click(function(){
        iterate++;
        $(addFields).append("<div class='form-group'><div class='input-group'><input type='text' placeholder='Label name' required name='field_"+iterate+"' class='form-control' required><input type='text' class='form-control' name='customfield_"+iterate+"' id='custom_field"+iterate+"' placeholder='value' required></div></div>");
        $('.CountExtraFields').val(iterate);
    });
    
    var testArr = ["tester","Reset"];
    $('.CustomFieldAdd').change(function(){
        const thisVal = $(this).val();

        switch(thisVal){
            case "Age":
                if($.inArray(thisVal,ExtraFields) == -1){
                    $(addFields).append("<div class='form-group'><label id='Age' class='ChangeFieldName'>Age</label><input type='text' class='form-control' name='Age' id='Age'></div>");
                    ExtraFields.push(thisVal);  
                }
                break;
            case "Nationality":
                if($.inArray(thisVal,ExtraFields) == -1){
                    $(addFields).append("<div class='form-group'><label id='Nationality' class='ChangeFieldName'>Nationality</label><input type='text' class='form-control' name='Nationality' id='Nationality'></div>");
                    ExtraFields.push(thisVal);  
                }
                break;
            case "Favourite Animal":
                if($.inArray(thisVal,ExtraFields) == -1){
                    $(addFields).append("<div class='form-group'><label id='Favoutiteanimal' class='ChangeFieldName'>Favourite animal</label><input type='text' class='form-control' name='Favoutiteanimal' id='Favoutiteanimal'></div>");
                    ExtraFields.push(thisVal);  
                }
                break;
            case "Current Car":
                if($.inArray(thisVal,ExtraFields) == -1){
                    $(addFields).append("<div class='form-group'><label id='currentcar' class='ChangeFieldName'>Current Car</label><input type='text' class='form-control' name='currentcar' id='currentcar'></div>");
                    ExtraFields.push(thisVal);      
                }
                break;
            return
        }
    });

});
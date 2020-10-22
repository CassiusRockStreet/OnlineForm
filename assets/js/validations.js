$('document').ready(function(){
    //initialize button Disable
    $('#submtForm').attr("disabled",false);

    //validate username
    $('#userName').focusout(function(){
        if($(this).val().length > 0){
            if(!$(this).val().match("^[a-zA-Z]+$")){
                $('.usernameMsg').html("Username should only be alphabets and no spaces");
                $('.usernameMsg').css("color","red");
                $(this).css('border','1px solid red');
                $('#submtForm').attr("disabled",true);
            }else{   
                $('.usernameMsg').html("");
                $(this).css('border','1px solid green');
                $('#submtForm').attr("disabled",false);
            }   
        }else{
            $('.usernameMsg').html("");
            $(this).css('border','1px solid green');
            $('#submtForm').attr("disabled",false);
        }
    });

    // ValidateEmail
    $('#userEmail').focusout(function(){
        if($(this).val().length > 0){
            if(!$(this).val().match("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$")){
                $('.emailMsg').html("Enter valid email address");
                $('.emailMsg').css("color","red");
                $(this).css('border','1px solid red');
                $('#submtForm').attr("disabled",true);
            }else{ 
                $('.emailMsg').html("");
                $(this).css('border','1px solid green');
                $('#submtForm').attr("disabled",false);
            }   
        }else{
            $('.emailMsg').html("");
            $(this).css('border','1px solid green');
            $('#submtForm').attr("disabled",false);
        }
    });

    //Validate mobile
    $('#userMobile').focusout(function(){
        if($(this).val().length > 0){
            if(!$(this).val().match("^[0-9]+$")){
                console.log($(this).val());   
                $('.mobileMsg').html("Enter valid Mobile number e.g 0xxxxxxxx");
                $('.mobileMsg').css("color","red");
                $(this).css('border','1px solid red');
                $('#submtForm').attr("disabled",true);
            }else{
                if($(this).val().length != 10){ 
                    $('.mobileMsg').html("Enter valid Mobile number e.g 0xxxxxxxx 10 digits");
                    $('.mobileMsg').css("color","red");
                    $(this).css('border','1px solid red');
                    $('#submtForm').attr("disabled",false);
                }else{
                    $('.mobileMsg').html("");
                    $(this).css('border','1px solid green');
                    $('#submtForm').attr("disabled",false);
                }
            }   
        }else{
            $('.mobileMsg').html("");
            $(this).css('border','1px solid green');
        }
    }); 
    
});
function sendFormAfterJsValidation(form, formSpacer) 
{
    $(formSpacer).text('');
    //ajax request
    $.ajax({
        type: $(form).attr('method'),
        url: ajax_url + '?action=contact',
        data: $(form).serialize(),
        dataType: 'json',
        success: function (data) 
        {
            if (data.status == "valid") {
//                console.log('sent');
                $(formSpacer).addClass('valid');
                $(formSpacer).text(data.message);
                //clear form after email send
                $(form).find("input[type=text], input[type=email],textarea").val("");
            } else {
                $(formSpacer).text(data.message);
            }
        },
        error: function (error) 
        {
//            console.log('error');
            console.log(error);
        }
    });
}
;
jQuery(document).ready(function ($) 
{
    $('.contact-form').on('submit', function (event) 
    {
//        console.log('submit');
        event.preventDefault();
        var field = $(this).find("input[name='field']").val();
        var name = $(this).find("input[name='name']").val();
        var surname = $(this).find("input[name='surname']").val();
        var email = $(this).find("input[name='email']").val();
        var message = $(this).find("textarea[name='message']").val();
          //regular expression rules for form fields
        var nameReg = /^[a-zA-ZżźćńółęąśŻŹĆĄŚĘŁÓŃ]+$/;
        var surnameReg = /^[a-zA-ZżźćńółęąśŻŹĆĄŚĘŁÓŃ -]+$/;
        //  xxxx@yyyy.zzz
        var emailReg = /^.+\@.+\..+$/;
        var messageReg = /^.{10,}$/;
        var formSpacer = $(this).find(".form-spacer");
        //clear validation message in form
        $(formSpacer).text('');
        $(formSpacer).removeClass('valid');
        $(formSpacer).show();
        //js form validation
        if (field) {
            $(formSpacer).text("Bots!");
        } else if (!email.trim() || !message.trim()) {
            $(formSpacer).text("Pola: email i wiadomość są wymagane.");
        } else if (name && !nameReg.test(name)) {
            $(formSpacer).text("Niepoprawny format pola Imię.");
        } else if (surname && !surnameReg.test(surname)) {
            $(formSpacer).text("Niepoprawny format pola Nazwisko.");
        } else if (!emailReg.test(email)) {
            $(formSpacer).text("Niepoprawny format pola E-mail.");
        } else if (!messageReg.test(message.trim())) {
            $(formSpacer).text("Niepoprawny format pola Wiadomość. Wiadomosć musi zawierać rzynajmniej 10 znaków.");
        } else {//form valid
            sendFormAfterJsValidation($(this), formSpacer);
        }
    });
    console.log('works');
});
<?php include 'header.php'?>
<article class='left-panel'>
<a href='mailto:jackmuratore@gmail.com'>Email</a> 
is the best way to contact me or you can use this
contact form below. Which will send me an email.
<form id='contact-me' action='handle-contact.php' method='get' class='contact-form'>
<input placeholder='First name' type='text' required name='first-name'>
<input placeholder='Last name' type='text' name='last-name'>
<input placeholder='Email' type='email' required name='email'>
<input placeholder='Phone' type='text' name='phone-number'>
<div id='human-check'>
</div>
<input type='hidden' id='human-question' name='human-question'>
<input placeholder='Answer here' type='text' name='human-check'>
<textarea placeholder='Comments or Questions' name='comments' rows='4' cols='70'>
</textarea>
</form>
<button id='send-btn'>Send</button>
<a href='/index.php'> <button id='cancel-btn'>Cancel</button></a>
</article>
<script>
var validate_form = function()
{
    if ( $('#contact-me input[name="first-name"]').val() === '')
        return "First name is required.";
    if ( $('#contact-me input[name="email"]').val() === '')
        return "Email is required.";
    if ( $('#contact-me input[name="email"]').val() === '')
        return 'Comments or Question field is required.'
        if ( $('#contact-me input[name="human-check"]').val() === '')
            return 'The human check field is required';
    return "";    
}

var send_invalid_form_msg = function(msg)
        {
            alert(msg);
        }

var human_check = function()
        {
            var $form = $('#human-question'),
        $div = $('#human-check'),
        a = Math.floor((Math.random() * 10) + 1),
        b = Math.floor((Math.random() * 10) + 1);

            $div.html('A Human check: What is ' + a + '+' + b);
            $form.val(a + ' ' + b);
        }

$(document).ready(function() {
    human_check();
    $('#send-btn').button({
        icons: {secondary: 'ui-icon-circle-check'}
    });
    $('#cancel-btn').button({
        icons: {secondary: 'ui-icon-circle-close'}
    });

    $('#send-btn').click(function() {
        var empty_field = "",
            data = {};
        //empty_field = validate_form();
        if (empty_field !== "") {
            send_invalid_form_msg(empty_field);
            return;
        }
<<<<<<< HEAD
        $('#contact-me').submit();
=======
        data = $('#contact-me').serialize();
        $.get('handle-contact.php', data, function(data) {
           console.log(data); 
           return true;
        });
>>>>>>> 1e890df61f86c8c6be6aa4d0b91f528ee1123308
    });
});
</script>
<?php include 'footer.php';?>

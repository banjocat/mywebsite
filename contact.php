<?php include 'header.php'?>
<article class='left-panel'>
<a href='mailto:jackmuratore@gmail.com'>Email</a> 
is the best way to contact me or you can use this
contact form below.
<form id='contact-me' class='contact-form'>
<input placeholder='First name' type='text' required name='first-name'>
<input placeholder='Last name' type='text' name='last-name'>
<input placeholder='Email' type='email' required name='last-name'>
<input placeholder='Phone' type='text' name='phone-number'>
<textarea placeholder='Comments or Questions' rows='4' cols='70'>
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
    return "";    
}

var send_invalid_form_msg = function(msg)
{
    alert(msg);
}

$(document).ready(function() {
    $('#send-btn').button();
    $('#cancel-btn').button();

    $('#send-btn').click(function() {
        var empty_field = "";
        empty_field = validate_form();
        if (empty_field !== "") {
            send_invalid_form_msg(empty_field);
            return;
        }
        $('#contact-form').submit();
    });
});
</script>
<?php include 'footer.php';?>

function validaXSS(strValue)
{
  var _sanitizer = new Sanitizer(strValue);
  var isValid = _sanitizer.sanitize_scripting();
  return isValid;
}
function validaEmail(strEmail)
{
  var _sanitizer = new Sanitizer( strEmail );
  var isValid = _sanitizer.sanitize_confirm_email( $('#conEmail').val() );
  return isValid;
}
function validaText(strValue)
{
  var _sanitizer = new Sanitizer(strValue);
  var isValid = _sanitizer.sanitize_text();
  return isValid;
}
function validaBirthDate(birthDate)
{
  var _sanitizer = new Sanitizer(birthDate);
  var isValid = _sanitizer.sanitize_birth_date("-");
  return isValid;
}
function validaForm()
{
  var submitForm = false;
  var preventScripting = false;
  if(validaEmail( $('#email').val() ))
  {
    if( validaXSS( $('#name').val()) && validaXSS( $('#lastName').val()) && validaXSS( $('#userName').val()) &&
      validaXSS( $('#email').val() ) && validaXSS( $('#birthDate').val()))
      {
        preventScripting = true;
      }
    if(preventScripting)
    {
      if( validaText( $('#name').val()) && validaText( $('#lastName').val()) && validaText( $('#userName').val()) &&
        validaText( $('#email').val() ) && validaText( $('#birthDate').val() ))
        {
          submitForm = true;
        }
      if(submitForm)
      {
        if( validaBirthDate( $('#birthDate').val() ) )
        {
          submitForm = true;
        }
        else {
          submitForm = false;
        }
      }
    }
  }else {
    $('#email').popover({content:"Confirm email, email must be the same"});
    alert("Email must be the same");
  }
  if($('#userName').val() != '')
  {
      verify_user();
  }
  if($('#email').val() != '')
  {
      verify_email();
  }
  return submitForm;
}

function validaXSS(strValue)
{
  var _sanitizer = new Sanitizer(strValue);
  var isValid = _sanitizer.sanitize_scripting();
  return isValid;
}
function validaText(strValue)
{
  var _sanitizer = new Sanitizer(strValue);
  var isValid = _sanitizer.sanitize_text();
  return isValid;
}
function validaForm()
{
  var submitForm = false;
  var preventScripting = false;
  if( validaXSS( $('#name').val()) && validaXSS( $('#lastName').val()) && validaXSS( $('#cardNumber').val()) &&
    validaXSS( $('#cardValidMonth').val() ) && validaXSS( $('#cardValidYear').val()) && validaXSS( $('#cvc').val() ))
    {
      preventScripting = true;
    }
    if(preventScripting)
    {
      if( validaText( $('#name').val()) && validaText( $('#lastName').val()) && validaText( $('#cardNumber').val()) &&
        validaText( $('#cardValidMonth').val() ) && validaText( $('#cardValidYear').val()) && validaText( $('#cvc').val() ))
        {
          submitForm = true;
        }
      if(submitForm)
      {
        submitForm = true;
      }
    }

  return submitForm;
}

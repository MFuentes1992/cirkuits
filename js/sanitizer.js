class Sanitizer
{
  constructor(strValue)
  { 
    this.strValue = strValue;
  }
  sanitize_confirm_email(strEmail2)
  {
    var isValid                 = false;
    var sanitizer_email_counter = 0;
    var SANITIZER_EMAIL_GOAL    = this.strValue.length; //We want to have the number of coincidences equals to the original email.
    if(this.strValue.length === strEmail2.length)
    {
      for (var alfa = 0; alfa < this.strValue.length; alfa++) {
        if(this.strValue[alfa] === strEmail2[alfa]) { sanitizer_email_counter ++; }
      }
    }
    if(sanitizer_email_counter == SANITIZER_EMAIL_GOAL) { isValid = true; }
    return isValid;
  }

  sanitize_scripting()
  {
    var scripts                    = [ "<script>", "html", "script", "SELECT",
     "select", "DELETE", "delete", "alert", "update", "UPDATE", "update", "FROM", "from", "1=1" ];
     var sanitizer_scripts_counter = 0;
     var SANITIZER_SCRIPTS_GOAL    = 0;
     var isValid                   = false;
     for (var alfa = 0; alfa < scripts.length; alfa++) {
       if(this.strValue.includes(scripts[alfa])) { sanitizer_scripts_counter ++; }
     }
     if(sanitizer_scripts_counter == SANITIZER_SCRIPTS_GOAL) { isValid = true; }
     return isValid;
  }

  sanitize_text()
  {
    var isValid                        = false;
    var specialCharSet                 = ['=', '<', '>', '|', '#', '&', '%', '*'];
    var sanitizer_special_char_counter = 0;
    var SANITIZER_SPECIAL_CHAR_GOAL    = 0; //because we dont want to find any supicius char in our values, we set our goal to 0 value.
    for (var alfa = 0; alfa < this.strValue.length; alfa++) {
      for (var beta = 0; beta < specialCharSet.length; beta++) {
        if( this.strValue[alfa] ===  specialCharSet[beta]) { sanitizer_special_char_counter ++; }
      }
    }
    if(sanitizer_special_char_counter == SANITIZER_SPECIAL_CHAR_GOAL) { isValid = true; }
    return isValid;
  }
  sanitize_birth_date(strSpecialChar)
  {
    var isValid                 = false;
    var sanitizer_birth_counter = 0;
    var SANITIZER_BIRTH_GOAL    = 2; // A date must have only 2 times this character. EJ: mm '/'(1) dd '/'(2) YYY

    for (var i = 0; i < this.strValue.length; i++)
    {
      if(this.strValue[i] === strSpecialChar) { sanitizer_birth_counter ++; }
    }
    if(sanitizer_birth_counter === SANITIZER_BIRTH_GOAL) { isValid = true; }
    return isValid;
  }
};

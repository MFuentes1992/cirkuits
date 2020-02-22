<div class="form">
  <form action="update_plastic.php" method="post" id="card-form">
    <span class="card-errors"></span>
    <div class="form form-group">
      <input type="text" class="form-control"
       data-conekta="card[name]"
       data-validation-engine="validate[required, custom[onlyLetterAccentSp]]"
       data-errormessage-value-missing="Name is required"
       data-errormessage-custom-error="Invalid, let me give you a hint: Andrew"
       name="name" id="name" placeholder="Name"/>
    </div>
    <div class="form form-group">
      <input type="text" class="form-control" name="lastName" id="lastName"
       data-validation-engine="validate[required, custom[onlyLetterAccentSp]]"
       data-errormessage-value-missing="Last name is required"
       data-errormessage-custom-error="Invalid, let me give you a hint: Garfield"
       placeholder="Last name" />
    </div>
    <div class="form form-group">
      <input type="text" class="form-control" name="cardNumber" id="cardNumber"
      data-conekta="card[number]"
      data-validation-engine="validate[required]"
      data-errormessage-value-missing="Card number is required"
      data-errormessage-custom-error="Invalid, let me give you a hint: 5504909923086138"
      placeholder="Card number" />
    </div>
    <div class="form form-group">
      <input type="text" class="form-control" id="cardValidMonth"
      data-conekta="card[exp_month]"
      data-validation-engine="validate[required]"
      data-errormessage-value-missing="Month is required"
      data-errormessage-custom-error="Invalid, let me give you a hint: 01"
      name="cardValidMonth" placeholder="MM" />
      <input type="number" class="form-control" id="cardValidYear"
      data-conekta="card[exp_year]"
      data-validation-engine="validate[required]"
      data-errormessage-value-missing="Year is required"
      data-errormessage-custom-error="Invalid, let me give you a hint: 20"
      name="cardValidYear" placeholder="YY" />
    </div>
    <div class="form form-group">
      <input type="text" class="form-control" name="cvc" id="cvc"
       data-conekta="card[cvc]"
       data-validation-engine="validate[required, length[0,2]]"
       data-errormessage-value-missing="cvc is required"
       data-errormessage-custom-error="Invalid, let me give you a hint: 000"
       placeholder="cvc" />
    </div>
    <br>
  </form>
</div>

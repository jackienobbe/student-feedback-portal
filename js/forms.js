//
// forms.js
//

function checkform_new_student(form, userID, userFName, userFName, major, currentYear)
{
    // Check each field has a value
    if (userID.value == ''	||
        userFName.value == ''	||
        userLName.value == ''	||
        major.value == ''		||
        currentYear.value == '')
        {
          alert('All fields are required. Please try again');
          return false;
        }
            
    // Finally submit the form.
    form.submit();
    return true;
}

function checkform_inv_num(form, inv_num)
{
    // Check each field has a value
    if (inv_num.value == '') {

        alert('You must provide the requested detail. Please try again');
        return false;
    }

    // Finally submit the form.
    form.submit();
    return true;
}

function checkform_pcode(form, pcode)
{
    // Check each field has a value
    if (pcode.value == '') {

        alert('You must provide the requested detail. Please try again');
        return false;
    }

    // Finally submit the form.
    form.submit();
    return true;
}

function checkform_ccode(form, ccode)
{
    // Check each field has a value
    if (ccode.value == '') {

        alert('You must provide the requested detail. Please try again');
        return false;
    }

    // Finally submit the form.
    form.submit();
    return true;
}

function checkform_invoice(form, inv_num, ccode, date, amount)
{
    // Check each field has a value
    if (inv_num.value == ''   ||
        ccode.value == ''    ||
        date.value == ''    ||
        amount.value == '' ) {

        alert('You must provide all the requested details. Please try again'); // + inv_num.value + ccode.value + date.value + amount.value);
        return false;
    }

    // TODO: Check the date


    // Finally submit the form.
    form.submit();
    return true;
}

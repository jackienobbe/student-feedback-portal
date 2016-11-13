//
// forms.js
//
function checkform_userID(form, userID)
{
  // Check each field has a value
  if (userID.value == ''){
        alert('All fields are required. Please try again');
        return false;
      }

  // Finally submit the form.
  form.submit();
  return true;
}
function checkform_login(form, userID, userPassword)
{
  // Check each field has a value
  if (userID.value == ''	||
      userPassword.value == '')
      {
        alert('All fields are required. Please try again');
        return false;
      }

  // Finally submit the form.
  form.submit();
  return true;
}

function checkform_new_student(form, userID, userPassword, major, currentYear)
{
    // Check each field has a value
    if (userID.value == ''	||
        userPassword.value == '' ||
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

function checkform_courseID(form, courseID)
{
    // Check each field has a value
    if (courseID.value == '') {

        alert('You must provide the requested detail. Please try again');
        return false;
    }

    // Finally submit the form.
    form.submit();
    return true;
}

function checkform_professorLName(form, professorLName)
{
  // Check each field has a value
  if (professorLName.value == '') {
      alert('You must provide the requested detail. Please try again');
      return false;
  }

  // Finally submit the form.
  form.submit();
  return true;
}

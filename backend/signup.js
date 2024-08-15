function validateForm(event){

      
    if (event) {
        event.preventDefault(); 
    }
    console.log("validating");

   var  isusernameValid =validateUName();
   var  ispasswordValid =vaidatePassword();

   return isusernameValid && ispasswordValid;
}
//  In the context of a form, the default action is usually to submit the form and reload the page.

function validateUName(){
 var usernameInput=document.getElementById("username");
 var usernameValue =usernameInput.value.trim();
var usernamePattern=/^[A-Za-z\s]+$/;
var usernameError=document.getElementById("usernameError");

if(usernameValue === ""){
    usernameError.innerHTML="Cannot have an empty fieldset";
    return false;
}
else if(!usernamePattern.test(usernameValue)){
usernameError.innerHTML="Invalid username";
return false;
}
else {
usernameError.innerHTML="";
return true;
}
}

function vaidatePassword(){
   var  passwordInput=document.getElementById("password");
   var  passwordValue=passwordInput.value.trim();
   var  passwordError=document.getElementById("passwordError");
    var passwordPattern1 = /^[0-9]+$/;
    var  passwordPattern2 = /^[A-Za-z]+$/;

    if(passwordValue===""){
        passwordError.innerHTML="Cannot have an empty fieldset";
        return false;
    }
    else if(passwordPattern1.test(passwordValue)){
  passwordError.innerHTML="Weak password:only contains numbers";
  return false;
    }

    else if(passwordPattern2.test(passwordValue)){
        passwordError.innerHTML="Weak password:only contains letters";
        return false;
    }
    else{
    passwordError.innerHTML="";
    return true;
    }
}




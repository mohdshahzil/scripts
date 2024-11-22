function validateForm() {
    let valid = true;
  
    // Name Validation
    const name = document.getElementById("name").value;
    const nameError = document.getElementById("nameError");
    const nameRegex = /^[A-Za-z\s]{3,}$/;
    if (!nameRegex.test(name)) {
      valid = false;
      nameError.textContent = "Name must contain at least 3 characters.";
    } else {
      nameError.textContent = "";
    }
  
    // Email Validation
    const email = document.getElementById("email").value;
    const emailError = document.getElementById("emailError");
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(email)) {
      valid = false;
      emailError.textContent = "Invalid email address.";
    } else {
      emailError.textContent = "";
    }
  
    // Password Validation
    const password = document.getElementById("password").value;
    const passwordError = document.getElementById("passwordError");
    const passwordRegex = /^.{6,}$/;
    if (!passwordRegex.test(password)) {
      valid = false;
      passwordError.textContent = "Password must be at least 6 characters.";
    } else {
      passwordError.textContent = "";
    }
  
    // Gender Validation
    const genderError = document.getElementById("genderError");
    if (!document.querySelector('input[name="gender"]:checked')) {
      valid = false;
      genderError.textContent = "Please select a gender.";
    } else {
      genderError.textContent = "";
    }
  
    // Country Validation
    const country = document.getElementById("country").value;
    const countryError = document.getElementById("countryError");
    if (country === "") {
      valid = false;
      countryError.textContent = "Please select a country.";
    } else {
      countryError.textContent = "";
    }
  
    // Terms and Conditions Validation
    const terms = document.getElementById("terms").checked;
    const termsError = document.getElementById("termsError");
    if (!terms) {
      valid = false;
      termsError.textContent = "You must agree to the terms and conditions.";
    } else {
      termsError.textContent = "";
    }
  
    // If form is valid, show the result below the form
    if (valid) {
      return true; // Submit the form if valid
    }
  
    return valid;
  }
  
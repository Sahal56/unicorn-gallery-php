function validLoginForm() {
    var x = document.forms["loginForm"]["username"].value;
    var z = document.forms["loginForm"]["password"].value;
    if (x == null || x == "") {
        alert("Enter name");
        return false;
    }
    if (z == null || z == "") {
        alert("Enter password");
        return false;
    }
    else if (z.length < 6) {
        alert("Password is less than 6 characters");
        return false;
    }
    return true;
}

function validRegForm() {
    var x = document.forms["registrationForm"]["username"].value;
    var y = document.forms["registrationForm"]["email"].value;
    var z = document.forms["registrationForm"]["password"].value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (x == null || x == "") {
        alert("Enter name");
        return false;
    }
    if (y == null || y == "") {
        alert("Enter email");
        return false;
    }
    if (!y.match(mailformat)) {
        alert("Incorrect email");
        return false;
    }
    if (z == null || z == "") {
        alert("Enter password");
        return false;
    }
    if (z.length < 6) {
        alert("Password is less than 6 characters");
        return false;
    }

    return true;
}
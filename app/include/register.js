function validate() {
    var name = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var repeat_password = document.getElementById('repeat_password').value;

    var user = {
        name: name,
        password: password,
        repeat_password: repeat_password
    };

    $errors = document.getElementById("errors");
    $errors.innerHTML = "";

    $errors.style.fontSize = "20px";
    $errors.style.backgroundColor = "rgb(245, 245, 240)";
    $errors.style.color = "red";
    $errors.style.width = "450px";
    $errors.style.margin = "auto";
    $errors.style.border = "2px solid";

    var isValidName = false;
    var isValidPass = false;
    var isValidRepeatPass = false;

    var nameReg= /^[\d\w]{3,10}$/g;
    var passReg= /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w\d]{6,}$/g;

    // if (user.name.match(nameReg) == null) {
    //     $errors.innerHTML = "Името трябва да съдържа поне 3 символа и най-много 10 символа - букви, цифри и _.";
    // } else {
    //     isValidName = true;
    // }

    // if (user.password.match(passReg) == null) {
    //     $errors.innerHTML += "Паролата трябва да съдържа поне 6 символа, като трябва да има поне 1 главна, 1 малка буква и 1 цифра.";
    // } else {
    //     isValidPass = true;
    // }

    // if (user.repeat_password != user.password) {
    //     $errors.innerHTML += "Втората парола трябвав да съвпада с първата.";
    // } else {
    //     isValidRepeatPass = true;
    // }

    // if (isValidName && isValidPass && isValidRepeatPass) {
    //     send(`data=${JSON.stringify(user)}`);
    // }

    send(`data=${JSON.stringify(user)}`);
}

function send(data) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            //document.getElementById("demo").innerHTML = xhttp.responseText;
        } else {
            console.log(xhttp.responseText);
        }
    }

    xhttp.open("POST", "../controllers/register.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}
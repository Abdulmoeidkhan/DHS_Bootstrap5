let profileUpdateForm = document.getElementById("userBasicInfo");
profileUpdateForm.addEventListener("submit", getValues);

function getValues(event) {
    event.preventDefault();
    let reqObj;
    for (val of event.target) {
        reqObj = {
            ...reqObj,
            [val['name']]: val['value'],
        }
    }
    axios.post('/updateProfile', reqObj)
        .then(function (response) {
            location.reload();
        })
        .catch(function (error) {
            console.log(error);
        });
}
let passwordUpdateForm = document.getElementById("userPasswordInfo");
passwordUpdateForm.addEventListener("submit", getPasswords);

function getPasswords(event) {
    event.preventDefault();
    let reqObj;
    for (val of event.target) {
        reqObj = {
            ...reqObj,
            [val['name']]: val['value'],
        }
    }
    if (reqObj.userInputPassword === reqObj.userInputPasswordConfirm) {
        axios.post('/updateProfilePassowrd', reqObj)
            .then(function (response) {
                console.log(response);
                location.href = "/logout";
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
            });
    }
    else {
        alert("Password Does not match")
    }
}

function checkPasswordStrength(password) {
    password.reportValidity();
}
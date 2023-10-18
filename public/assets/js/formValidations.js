let loginForm = document.getElementById("userBasicInfo");
loginForm.addEventListener("submit", getValues);

function getValues(event) {
    event.preventDefault();
    // console.log(axios.get('https://weatherstack.com/signup/free'));
}
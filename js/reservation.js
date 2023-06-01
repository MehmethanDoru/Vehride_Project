const openStep2 = document.getElementById('openStep2');
const step2 = document.getElementById('step2');
openStep2.addEventListener('click', () => {
    if (step2.style.display == 'none') {
        step2.style.display = 'block';
        document.getElementById("rentInfo").style.borderColor = "green";
    } else {
        step2.style.display = 'none';
        document.getElementById("rentInfo").style.borderColor = "";
    }
});
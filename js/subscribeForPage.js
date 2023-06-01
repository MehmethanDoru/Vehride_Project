function submitForm(event) {
    event.preventDefault();

    var form = document.getElementById("subscribeForm");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../subscribe.php", true);

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xhr.responseText);
            document.getElementById("processMessage").innerHTML = xhr.responseText;
            document.getElementById("subscribeForm").reset();
        }
    };
    xhr.send(formData);
}
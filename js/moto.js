function updateSecondSelect(event) {
    
    var form = document.getElementById("brandForm");
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "motoModel.php", true);

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xhr.responseText);
            document.getElementById('model').innerHTML = xhr.responseText;
        }
    };
    xhr.send(formData);
  } 


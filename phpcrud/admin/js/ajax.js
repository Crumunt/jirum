const table_contents = document.getElementById('table-contents');

//tells window that onload call loadStudents function
window.onload = loadStudents();


function showData(value) {

    // creates a new XMLTHttpRequest object
    let xmlhttp = new XMLHttpRequest();

    // calls function on state-change
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('staticBackdropLabel').textContent = 'Update';
            document.getElementById("formData").innerHTML = this.responseText;

            let confirmButton = document.querySelector("button.confirm");

            confirmButton.setAttribute('id', 'update');
            confirmButton.setAttribute('value', value);
            confirmButton.setAttribute('onclick', 'updateData(this.value)');
        }
    };
    // opens file with the GET method as asynchronously
    xmlhttp.open("GET", `/jirum/phpcrud/form_handlers/adminHandler.php?id=${value}&action=showData`, true);

    // executes open
    xmlhttp.send();
}

function confirmDelete(value) {

    let xmlhttp = new XMLHttpRequest();

    xmlhttp.open('GET', `/jirum/phpcrud/form_handlers/adminHandler.php?confirmDelID=${value}&action=delete`);

    xmlhttp.addEventListener('load', function () {

        if (this.status == 200 && this.readyState == 4) {
            document.getElementById('staticBackdropLabel').textContent = 'Delete';
            document.getElementById("formData").innerHTML = this.responseText

            let confirmButton = document.querySelector("button.confirm");

            confirmButton.setAttribute('id', 'delete');
            confirmButton.setAttribute('value', value);
            confirmButton.setAttribute('onclick', 'deleteData(this.value)');

        } else {
            document.getElementById("formData").innerHTML = "Error Getting Data";
        }
    })

    xmlhttp.send();
}

function deleteData(id) {

    let data = new FormData();
    data.append('delID', id)

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log(this.responseText);
            loadStudents();
        }
    }

    xhr.open('POST', `/jirum/phpcrud/form_handlers/adminHandler.php`, true);
    xhr.send(data);

}

function getFormData(id) {
    return document.getElementById(id);
}

function updateData(id) {

    let data = new FormData();
    data.append('updateID', getFormData('updateID').value);
    data.append('name', getFormData('name').value);
    data.append('age', getFormData('age').value);
    data.append('email', getFormData('email').value);
    data.append('gpa', getFormData('gpa').value);

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log(this.responseText);
            loadStudents();
        }
    }

    xhr.open('POST', '/jirum/phpcrud/form_handlers/adminHandler.php', true);
    xhr.send(data);
}

function loadStudents() {

    let data = new FormData();
    data.append('loadAll', 'load');

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            // console.log(this.responseText);
            table_contents.innerHTML = this.responseText;
        }
    }

    xhr.open('POST', '/jirum/phpcrud/form_handlers/adminHandler.php', true);
    xhr.send(data);

}
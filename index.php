<?php /*
 CRUD = Create, Read, Update, Delete.
 1. Create a database in MySQL with a table named "users". 
 The table should have the following columns: id (auto-increment), name, email, 
 and password (hashed).
 2. Create a PHP file named "index.php" that displays a list of all the users in the "users" 
 table.
 3.Add a form to the "index.php" file that allows users to add new users to the "users" table.
 4.When a new user is added, the form should validate that the name and email fields 
 are not empty and that the email field is a valid email address. 
 The password field should be hashed before being inserted into the database.
 5.Add a button to each row in the user list that allows users to edit or delete the user.)
 6.When the edit button is clicked, the user should be taken to a new PHP
 file named "edit.php" 
 that allows them to edit the user's name, email, and password.
 7.When the delete button is clicked, the user should be deleted from the "users" table.
 */

include 'connection.php';

if ($conn) {
    $querytableUser = "CREATE TABLE IF NOT EXISTS `users` (
        `user_id` int(11) unsigned NOT NULL auto_increment,
        `name` varchar(155) NOT NULL,
        `email` varchar(155) NOT NULL,
        `password` varchar(255) NOT NULL,
        PRIMARY KEY (`user_id`)
    )";

    mysqli_query($conn, $querytableUser);

}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manager</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

    <style>
        h2 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        form {
            margin-bottom: 50px;
        }
    </style>
</head>

<body>


    <header>
        <!-- Navbar -->
        <?php require_once 'nav.html'; ?>
        <!-- Navbar -->

        <!-- Jumbotron -->
        <div class="p-5 text-center bg-light" style="margin-top: 58px;">
            <h1 class="mb-3">Users Management</h1>
            <h4 class="mb-3">List and Insert</h4>
        </div>
        <!-- Jumbotron -->
    </header>

    <div class="container mt-5">

        <div class="grid" style="--bs-columns: 10; --bs-gap: 1rem;">
            <div class="d-flex justify-content-center">
                <form style="with:400px" id="signup" data-action="insert" class="needs-validation form-user" novalidate>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" name="first_name" id="first_name" class="form-control " />
                                <label class="form-label" for="first_name">First name</label>
                                <div class="first_name"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" name="last_name" id="last_name" class="form-control" />
                                <label class="form-label" for="last_name">Last name</label>
                                <div class="last_name"></div>

                            </div>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control" />
                        <label class="form-label" for="email">Email address</label>
                        <div class="email"></div>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                        <div class="password"></div>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" id="btnSubmit" class="btn btn-primary mb-4">
                        Insert User</button>

                    <a href="#" id="btnClean" class="btn btn-outline-info  mb-4 ml-4" data-mdb-ripple-color="dark">
                        Clean Form</a>

                </form>
            </div>
            <div class="g-col-8">
                <table class="table align-middle mb-0 bg-white table-list-users">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-user">
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                                        style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 user-name">John Doe</p>
                                        <p class="text-muted mb-0 user-email">john.doe@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Software engineer</p>
                                <p class="text-muted mb-0">IT department</p>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-floating btn-update-user"
                                    data-mdb-ripple-color="dark">
                                    <i class="fas fa-magic"></i>
                                </button>
                                <a href="#" class="btn btn-outline-danger btn-floating btn-delete-user"
                                    data-mdb-ripple-color="dark">
                                    <i class="fas fa-trash-can"></i>
                                </a>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- my script-->
    <script>

        function allUsers() {  // FUNCTION THAT DISPLAY ALL USERS IN A TABLE
            fetch('list_users.php')
                .then(reponse => reponse.json())
                .then(data => {
                    
                    //document.querySelector(".table-list-users tbody").append(template.cloneNode(false));

                    const template = document.querySelector(".item-user");
                    document.querySelector(".table-list-users tbody").innerHTML = "";
                    for (const user of data) {
                        console.log(user);

                        const clone = template.cloneNode(true);
                        document.querySelector(".table-list-users tbody").append(clone);
                        clone.querySelector(".user-name").innerText = user.name;
                        clone.querySelector(".user-email").innerText = user.email;
                        clone.id = user.user_id;

                        // delete user
                        clone.querySelector(".btn-delete-user").addEventListener('click', function (e) {
                            e.preventDefault();

                            fetch('delete_user.php?id=' + user.user_id,
                                {
                                    method: 'GET',
                                })
                                .then(rep => rep.json())
                                .then((res) => {
                                    if (res.success) {
                                        //alert(res.message);
                                        allUsers();
                                        cleanAll();
                                    } else {
                                        alert('error');
                                    }
                                })
                        });

                        // send info of the selected user to the form for update
                        clone.querySelector(".btn-update-user").addEventListener('click', function (e) {
                            e.preventDefault();

                            document.getElementById('first_name').value = user.name;
                            document.getElementById('email').value = user.email;
                            document.getElementById('password').value = user.password;

                            document.querySelector('.form-user').dataset.action = 'update'; // change the action to update
                            document.querySelector('.form-user').dataset.user = user.user_id; // pass the user id 

                            document.getElementById('btnSubmit').classList.add('btn-success');
                            document.getElementById('btnSubmit').classList.remove('btn-primary');
                            document.getElementById('btnSubmit').innerText = 'Update User';


                        });

                    }
                    template.remove();


                })
        }

        allUsers();  // DISPLAY ALL USERS





        function btnInnnerHTML(state) { // FOR EFFECT LOADING
            let innerHTML = "Insert User";

            if (state === "load") {
                innerHTML = "<div class='spinner-border text-light spinner-border-sm' role='status'>"
                    + "<span class='visually-hidden'>Loading...</span> </div> " + document.getElementById('btnSubmit').innerText;
            }
            if (state === "success") {
                innerHTML = "<i class='fas fa-check'></i> User Inserted";
            }

            return innerHTML;
        }


        function cleanAll() { // FUNCTION CLEAN FORM
            document.querySelectorAll('input').forEach(element => {
                element.classList.remove('is-invalid');
                element.classList.remove('is-valid');
                element.value = "";
            });

            document.querySelector('.form-user').dataset.action = 'insert'; // put in normal action = insert
            document.querySelector('.form-user').dataset.user = ''; // remove the id user

            document.getElementById('btnSubmit').classList.remove('btn-success');
            document.getElementById('btnSubmit').classList.add('btn-primary');
            document.getElementById('btnSubmit').innerText = 'Insert User';

        }

        const form = document.getElementById('signup');  // INSERT AND UPDATE IN DATABASE JS
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const action = this.dataset.action;  // show the action to be done at the moment: insert / update

            // spinner loader ... 
            document.getElementById("btnSubmit").innerHTML = btnInnnerHTML('load');

            // take the data from the form
            const formData = new FormData(this);

            if (action === "insert") { // INSERT ACTION

                // prepare for send form to php file
                fetch('register.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        //alert(true);
                        if (data.success) { // if  is true = success send   

                            // spinner loader success
                            document.getElementById("btnSubmit").innerHTML = btnInnnerHTML('success');

                            allUsers(); // update list users with new one
                            cleanAll(); // clean the form                  

                        } else {
                            console.log(data);
                            // spinner loader normal = not action
                            document.getElementById("btnSubmit").innerHTML = btnInnnerHTML('normal');

                            if (data.typeError === 'validation') {

                                document.querySelectorAll('input').forEach(element => {
                                    element.classList.remove('is-invalid');
                                });

                                validationForm('first_name', data[0].first_name); // validation first name
                                validationForm('last_name', data[0].last_name); // validation last name
                                validationForm('email', data[0].email); // validation email
                                validationForm('password', data[0].password); // validation password                          


                            } else if (data.typeError === 'insert') {
                                //alert('send with success');
                                console.log(data.message)

                            } else { // other error 
                                //alert(data.typeError);
                                console.log(data.typeError);

                            }
                        }
                    })
                    .catch(error => console.error(error));

            } else { // UPDATE ACTION                  

                const idUser = document.querySelector('.form-user').dataset.user; //  get the corrent user id
                console.log(idUser);

                fetch('update.php?iduser=' + idUser, { //pass id user for do update
                    method: 'POST',
                    body: formData
                })
                    .then(resp => resp.json())
                    .then(res => {
                        if (res.success) {
                            // spinner loader success
                            document.getElementById("btnSubmit").innerHTML = btnInnnerHTML('success');
                            allUsers(); // update list users with new one
                            cleanAll(); // clean the form    
                        } else {

                            // spinner loader normal = not action
                            document.getElementById("btnSubmit").innerHTML = btnInnnerHTML('normal');

                            if (res.typeError === 'validation') {

                                document.querySelectorAll('input').forEach(element => {
                                    element.classList.remove('is-invalid');
                                });

                                validationForm('first_name', res[0].first_name); // validation first name
                                validationForm('last_name', res[0].last_name); // validation last name
                                validationForm('email', res[0].email); // validation email
                                validationForm('password', res[0].password); // validation password                          


                            } else if (res.typeError === 'update') {
                                //alert('send with success');
                                console.log(res.message)

                            }

                        }
                    });

            }
        });

        function validationForm(inputString, inputElement) {  //  VALIDATION           

            if (inputElement !== undefined) {
                document.getElementById(inputString).classList.add('is-invalid');
                document.querySelector('.' + inputString).innerText = inputElement;

                document.querySelector('.' + inputString).classList.remove('valid-feedback');
                document.querySelector('.' + inputString).classList.add('invalid-feedback');
            } else {
                document.getElementById(inputString).classList.add('is-valid');
                document.querySelector('.' + inputString).innerText = 'look good!';

                document.querySelector('.' + inputString).classList.remove('invalid-feedback');
                document.querySelector('.' + inputString).classList.add('valid-feedback');

            }
        }


        document.getElementById('btnClean').addEventListener('click', function (e) { //  BUTTON CLEAN
            e.preventDefault();
            cleanAll(); // clean the form 
        });


    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>
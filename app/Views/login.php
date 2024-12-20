<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Login</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <!-- Nested Row within Card Body -->
                    <div class="row  align-items-center m-0 g-3">
                        <div class="col-lg-6  d-lg-block bg-login-image pl-0">
                            <img src="public/assets/img/login-img.jpg" alt="" class="w-100 img-fluid" style=" object-fit: cover; aspect-ratio: 1/1;">
                        </div>
                        <div class="col-lg-6">
                            <div class="">
                                <div class="text-center">
                                    <h1 class="h4 text-dark mb-4"><b>Welcome to Login</b> </h1>
                                </div>
                                <form class="user" id="login-form">
                                    <div class="form-group">
                                        <input type="email" required class="form-control form-control-user"
                                            id="username" aria-describedby="username"
                                            placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" required class="form-control form-control-user"
                                            id="password" placeholder="Password">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/assets/js/sb-admin-2.min.js"></script>

</body>
<script>
        $(document).ready(function() {
            $('#login-form').submit(function(e) {
                e.preventDefault(); 
                var username = $('#username').val();
                var password = $('#password').val();
                if(password!='' && username!=''){

               
                fetch('<?=base_url('auth/login')?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ username: username, password: password })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) {
                        localStorage.setItem('jwt_token', data.token);
                        window.location.href = '<?=base_url('dashboard') ?>';
                    } else {
                        alert('Invalid credentials');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            }else{
                alert('All Field is required');
            }
            });
        });
    </script>
</html>
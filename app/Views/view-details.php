<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User Details</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr width="20%">
                            <th>First Name</th>
                            <th id="first_name"></th>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <th id="last_name"></th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th id="email"></th>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <th id="role_name"></th>
                        </tr>
                        <tr>
                            <th>Profile Pic</th>
                            <th><div id="profile_img"></div></th>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">

                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Education Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th width="20%">Course name</th>
                            <th id="course_name"></th>
                        </tr>
                        <tr>
                            <th>Passing Year</th>
                            <th id="passing_year"></th>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">

                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employment Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <th width="20%">Company Name</th>
                            <th id="company_name"></th>
                        </tr>
                        <tr>
                            <th>Position</th>
                            <th id="position"></th>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fetchUserData(id) {

        var token = localStorage.getItem('jwt_token');
        var base_url = "<?= base_url('user') ?>";
        var url = base_url + '/' + id;

        img_url= "<?= base_url() ?>/public/uploads";

        fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(result => {
                var user_data=result.data;
               $("#first_name").text(user_data.first_name);
               $("#last_name").text(user_data.last_name);
               $("#email").text(user_data.email);
               $("#role_name").text(user_data.role_name);
               $("#course_name").text(user_data.course_name);
               $("#passing_year").text(user_data.passing_year);
               $("#company_name").text(user_data.company_name);
               $("#position").text(user_data.position); 
               if(user_data.profile_img!=''){
                    img=`<img height="100" width="100" src="${img_url}/${user_data.profile_img}">`;
                    $("#profile_img").html(img);
               }
               
                 console.log(result.data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    fetchUserData(<?=$id ?>);
</script>
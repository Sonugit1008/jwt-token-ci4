<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

    <style>
        .fieldset-custum {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 15px;

            legend {
                font-size: 16px;
                font-weight: bold;
                display: inline-block !important;
                width: auto;
            }
        }

        .cropper-container {
            width: 371px !important;
            height: 247px !important;
        }

        .cropper-crop-box {
            width: 296.8px !important;
            height: 197.466px !important;
            left: 37.1px !important;
            top: 24.767px !important;
        }

        .cropper-canvas>img {
            width: 371px !important;
            height: 246.832px !important;
            margin-left: 0px !important;
            margin-top: 0px !important;
            transform: none;
        }

        .cropper-view-box>img {
            width: 371px !important;
            height: 246.832px !important;
            margin-left: -37.1px !important;
            margin-top: -24.6832px !important;
            transform: none !important;

        }

        #cropped {
            width: 97px;
            height: 200px;
        }

        .cropper-canvas {
            width: 371px !important;
            height: 246.832px !important;
            left: 0px !important;
            top: 0.0837974px !important;
        }

        /* .cropper-view-box{
    width: 371px !important;
    height: 246.832px !important;
    margin-left: -32.6px !important;
    margin-top: -32.6503px !important;
    transform: none;
} */
    </style>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <form class="row g-3" id="user-reg" method="POST">
                <div class="col-md-6  mb-4">
                    <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="first_name" required name="first_name">
                </div>
                <div class="col-md-6  mb-4">
                    <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="last_name" required name="last_name">
                </div>
                <div class="col-md-6  mb-4">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" required name="email">
                </div>
               
                <div class="col-md-6  mb-4">
                    <label for="inputState" class="form-label">Role <span class="text-danger">*</span></label>
                    <select id="role" class="form-control" name="role" required>
                        <option hidden>Select role</option>
                        <option value="1">Admin</option>
                        <option value="2">Customer</option>
                    </select>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="mb-3">
                        <input type="hidden" id="imgcode" name="imglogo" />
                        <label class="form-label" for="signature">Photo</label>

                        <main class="page">
                            <input type="file" id="file-input" accept="image/*" class="form-control" name="signature">
                            <p id="signature-error"></p>

                            <div class="row">
                                <div class="box-2-option">
                                    <div class="result"></div>
                                </div>
                                <div class="box-2-option img-result hide">
                                    <img class="cropped" src="" alt="">
                                </div>
                            </div>
                            <div class="box-option">
                                <div class="options hide" id="crop_id">
                                    <input type="hidden" class="img-w" value="200" min="200" max="200" />
                                    <button class="btn btn-primary save rounded-pill">Crop</button>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
                <div class="col-md-12">
                    <fieldset class="fieldset-custum">
                        <legend>Education detail:</legend>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="course_name" class="form-label">Course Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="course_name" required name="course_name">
                                <input type="hidden" class="form-control" id="education_id" required name="education_id">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="passing_year" class="form-label">Passing year <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="passing_year" required name="passing_year">
                            </div>
                        </div>

                    </fieldset>
                </div>
                <div class="col-md-12">
                    <fieldset class="fieldset-custum">
                        <legend>Employment detail:</legend>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="company_name" class="form-label">Company name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_name" required name="company_name">
                                <input type="hidden" class="form-control" id="employment_id" required name="employment_id">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" required name="position">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <button type="submit" class="btn btn-primary ml-2">Update</button>

            </div>


    </div>
    </form>
</div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    
    $(document).ready(function() {
    $('#user-reg').submit(function(e) {
        e.preventDefault(); 
      

        var edit_url = "<?= base_url('user/' . $id); ?>";
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var imglogo = $('#imgcode').val();
        var course_name = $('#course_name').val();
        var passing_year = $('#passing_year').val();
        var company_name = $('#company_name').val();
        var position = $('#position').val();

        var education_id = $('#education_id').val();
        var employment_id = $('#employment_id').val();

        var role = $('#role').val();
        var token = localStorage.getItem('jwt_token');
        fetch(edit_url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token,
                },
                body: JSON.stringify({
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    password: password,
                    imglogo: imglogo,
                    course_name: course_name,
                    passing_year: passing_year,
                    company_name: company_name,
                    position: position,
                    education_id:education_id,
                    employment_id:employment_id,
                    role:role
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.message) {
                   window.location.href = '<?= base_url('user-list') ?>';
                } else {
                    console.error('Operation failed:', data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
       
    });
});

</script>
<script>
    let result = document.querySelector('.result'),
        img_result = document.querySelector('.img-result'),
        img_w = document.querySelector('.img-w'),
        img_h = document.querySelector('.img-h'),
        options = document.querySelector('.options'),
        save = document.querySelector('.save'),
        cropped = document.querySelector('.cropped'),
        //dwn = document.querySelector('.download'),
        upload = document.querySelector('#file-input'),
        cropper = '';

    // on change show image with crop options
    upload.addEventListener('change', e => {
        if (e.target.files.length) {
            // start file reader
            const reader = new FileReader();
            reader.onload = e => {
                if (e.target.result) {
                    // create new image
                    let img = document.createElement('img');
                    img.id = 'image';
                    img.src = e.target.result;
                    // clean result before
                    result.innerHTML = '';
                    // append new image
                    result.appendChild(img);
                    // show save btn and options
                    save.classList.remove('hide');
                    options.classList.remove('hide');
                    // init cropper
                    cropper = new Cropper(img);
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // save on click
    save.addEventListener('click', e => {
        e.preventDefault();
        // get result to data uri
        let imgSrc = cropper.getCroppedCanvas({
            width: img_w.value // input value
        }).toDataURL();
        // remove hide class of img
        cropped.classList.remove('hide');
        img_result.classList.remove('hide');
        // show image cropped
        // console.log(imgSrc);
        $("#imgcode").attr("value", imgSrc);
        cropped.src = imgSrc;

    });

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
       $("#first_name").val(user_data.first_name);
       $("#last_name").val(user_data.last_name);
       $("#email").val(user_data.email);
       $("#role").val(user_data.role);
       $("#course_name").val(user_data.course_name);
       $("#passing_year").val(user_data.passing_year);
       $("#company_name").val(user_data.company_name);
       $("#position").val(user_data.position); 
       $('#education_id').val(user_data.education_id);
      $('#employment_id').val(user_data.employment_id);
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
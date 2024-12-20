
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User List</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success  m-2">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fetchUserData() {
    var token = localStorage.getItem('jwt_token');  
    
    var view_details = "<?=base_url('view_details')?>";
    var edit_user = "<?=base_url('edit-user')?>";

    fetch('<?=base_url('user')?>', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(result => {
        
        result.data.forEach((user,i) => {
            const row = `<tr>
                            <td>${i+1}</td>
                            <td>${user.first_name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.email}</td>
                             <td><a href="${edit_user}/${user.id}">Edit</a><a href="${view_details}/${user.id}" class="ml-2">View</a> </td>
                        </tr>`;
            $('#table-data').append(row);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
fetchUserData();

</script>

   
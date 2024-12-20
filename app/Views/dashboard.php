<div class="container-fluid">
<?php date_default_timezone_set('Asia/Kolkata'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Login Details</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Login Details</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <th>First Name</th>
                            <th><?=session()->get('first_name'); ?></th>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <th><?=session()->get('last_name'); ?></th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th><?=session()->get('email'); ?></th>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <th><?=session()->get('role_name'); ?></th>
                        </tr>
                        <tr>
                            <th>Last Login</th>
                            <th><?=date('d-m-Y H:i:s',strtotime(session()->get('last_login'))); ?></th>
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

        fetch('<?= base_url('user') ?>', {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(result => {

                result.data.forEach((user, i) => {
                    const row = `<tr>
                            <td>${i+1}</td>
                            <td>${user.first_name}</td>
                            <td>${user.last_name}</td>
                            <td>${user.email}</td>
                             <td><a href="${base_url}/${user.id}">View</a></td>
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
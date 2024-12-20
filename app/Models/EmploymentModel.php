<?php

namespace App\Models;

use CodeIgniter\Model;

class EmploymentModel extends Model
{
    protected $table = 'user_employment';
    protected $allowedFields = [
        'id',
        'user_id',
        'company_name',
        'position',
        'created_at',
        'updated_at',
    ];

}

?>
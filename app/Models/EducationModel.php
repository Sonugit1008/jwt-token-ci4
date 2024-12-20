<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationModel extends Model
{
    protected $table = 'user_education';
    protected $allowedFields = [
        'id',
        'user_id',
        'course_name',
        'passing_year',
        'created_at',
        'updated_at',
    ];

}

?>
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EducationModel;
use App\Models\EmploymentModel;
use App\Models\UserModel;
use EmptyIterator;

class UserController extends BaseController
{
    protected $userModel;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $items = $this->userModel->select('id, first_name, last_name, email, role, profile_img,')->orderBy('id', 'DESC')->limit(5)->findAll();
        return $this->response->setJSON(['status' => 'success', 'data' => $items]);
    }

    public function addUsesr()
    {

        $rules = [
            'first_name' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'email' => 'required|min_length[3]|max_length[30]|is_unique[users.email]',
            'password' => 'required|min_length[6]',

        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'failed', 'errors' => $this->validator->getErrors()]);
        }


        $hashedPassword = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        $email = $this->request->getVar('email');
        $imglogo = $this->request->getVar('imglogo');

        if($imglogo!=''){
            $folderPath = 'public/uploads';
            $profile_img=saveBase64Image($imglogo,$folderPath);
            
        }
        $userdata = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'password' => $hashedPassword,
            'role' => $this->request->getVar('role'),
            'profile_img' => $profile_img

        ];
        $userModel = new UserModel();
        if ($userModel->where('email', $email)->first()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Username already exists'])->setStatusCode(409);
        }
        $this->userModel->insert($userdata);
        $userId = $this->db->insertId();

        if ($userId != '') {

            $educationModel = new EducationModel();
            $educationData = [
                'course_name' => $this->request->getVar('course_name'),
                'passing_year' => $this->request->getVar('passing_year'),
                'user_id' => $userId,
            ];
            $educationModel->insert($educationData);

            $employmentModel = new EmploymentModel();
            $employmentData = [
                'company_name' => $this->request->getVar('company_name'),
                'position' => $this->request->getVar('position'),
                'user_id' => $userId,
            ];
            $employmentModel->insert($employmentData);
        }
        session()->setFlashdata('success', 'User registered successfully!');
        return $this->response->setJSON(['status' => 'success', 'message' => 'User added successfully.']);
    }

    public function show($id)
    {

        $userModel = new UserModel();
        $data = $userModel->select('users.id, users.first_name, users.last_name, users.email, users.role, users.profile_img, user_education.course_name, user_education.passing_year, user_employment.company_name, user_employment.position,roles.role_name,user_education.id as education_id,user_employment.id as employment_id')
            ->join('roles', 'roles.id = users.role', 'inner') 
            ->join('user_education', 'user_education.user_id = users.id', 'inner')
            ->join('user_employment', 'user_employment.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->first();

        if ($data) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ]);
        }
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'User not found'
        ])->setStatusCode(404);
    }

    public function update($id)
    {
        $rules = [
            'first_name' => 'required|min_length[3]',
            'last_name' => 'required|min_length[3]',
            'email' => 'required|min_length[3]|max_length[30]'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'failed', 'errors' => $this->validator->getErrors()]);
        }
      

         $imglogo = $this->request->getVar('imglogo');

        if($imglogo!=''){
            $folderPath = 'public/uploads';
            $profile_img=saveBase64Image($imglogo,$folderPath);
        }



        $userdata = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),

        ];
        if($imglogo!=''){
            $userdata['profile_img']=$profile_img;
        }
        // print_r($userdata);
        $this->userModel->update($id, $userdata);

        $educationModel = new EducationModel();

         $employment_id=$this->request->getVar('employment_id');
         $education_id=$this->request->getVar('education_id');  
       
        $educationData = [
            'course_name' => $this->request->getVar('course_name'),
            'passing_year' => $this->request->getVar('passing_year')
        ];
        $educationModel->update($education_id, $educationData);

        $employmentModel = new EmploymentModel();
        $employmentData = [
            'company_name' => $this->request->getVar('company_name'),
            'position' => $this->request->getVar('position')
        ];
        $employmentModel->update($employment_id, $employmentData);
        session()->setFlashdata('success', 'Udate user data successfully!');

        return $this->response->setJSON(['status' => 'success', 'message' => 'Udate user data successfully']);
    }

    public function delete($id)
    {
        $this->userModel->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Item deleted']);
    }

    public function UserList()
    {

        return loadView('user-list');
    }

    public function AddUser()
    {

        return loadView('add-user');
    }

    
    public function ViewDetails($id)
    {
        $data['id']=$id;
        return loadView('view-details',$data);
    }

    public function editUser($id)
    {
        $data['id']=$id;
        return loadView('edit-user',$data);
    }

    public function accessDenied()
    {
        return view('access-denied');
    }
}

<?php namespace App\Controllers;

class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        return view('user/index');
    }

    public function create()
    {
        if($this->request->getPost())
        {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'user');
            $errors = $this->validation->getErrors();

            if(!$errors)
            {
                $userModel = new \App\Models\UserModel();

                $user = new \App\Entities\User();

                $user->fill($data);

                $user->role = 1;
                $user->avatar = $this->request->getFile('avatar');
                $user->created_by = 0;
                $user->created_at = date("Y-m-d H:i:s");

                $userModel->save($user);

                $id = $userModel->insertID();

                $segments = ['user','index'];

                $this->session->setFlashdata('success', 'Input Data Berhasil');

                return redirect()->to(base_url($segments));
            }

            $this->session->setFlashdata('errors', $errors);
        }

        return view('user/create');
    }
}
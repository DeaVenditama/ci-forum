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
        $modelUser = new \App\Models\UserModel();
        $users = $modelUser->findAll();

        return view('user/index', [
            'users' => $users,
        ]);
    }

    public function view()
    {
        $id = $this->request->uri->getSegment(3);
        $modelUser = new \App\Models\UserModel();
        $user = $modelUser->find($id);

        return view('user/view',[
            'user' => $user
        ]);
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
        if($this->session->role===0)
        {
            return view('user/create');
        }else{
            return redirect()->to(base_url('auth/register'));
        }
        
    }

    public function update()
    {
        $id = $this->request->uri->getSegment(3);

        $modelUser = new \App\Models\UserModel();

        if($this->request->getPost())
        {
            $data = $this->request->getPost();
            $this->validation->run($data, 'userupdate');
            $errors = $this->validation->getErrors();

            if(!$errors)
            {
                $userEntity = new \App\Entities\User();
                $userEntity->fill($data);
                if($this->request->getFile('avatar')->isValid()){
                    $userEntity->avatar = $this->request->getFile('avatar');
                }
                $userEntity->updated_by = 0;
                $userEntity->updated_at = date("Y-m-d H:i:s");

                $modelUser->save($userEntity);

                $segments = ['user','view', $id];
                
                $this->session->setFlashdata('success','Update Data Berhasil');

                return redirect()->to(base_url($segments));
            }

            $this->session->setFlashdata('errors', $errors);
        }

        $user = $modelUser->find($id);
        
        return view('user/update',[
            'user'=>$user,
        ]);
    }

    public function delete()
    {
        $id = $this->request->uri->getSegment(3);

        $modelUser = new \App\Models\UserModel();

        $modelUser->delete($id);

        $this->session->setFlashdata('success', 'Delete User Berhasil');

        return redirect()->to(base_url('user/index'));
    }
}
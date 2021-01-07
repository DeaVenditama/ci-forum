<?php namespace App\Controllers;
use \App\Models\ThreadModel;
use \App\Models\KategoriModel;
use \App\Models\UserModel;
use \App\Models\ReplyModel;

class Reply extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function create()
    {
        $id_thread = $this->request->uri->getSegment(3);

        $modelThread = new ThreadModel();
        $thread = $modelThread->find($id_thread);

        $modelReply = new ReplyModel();

        if($this->request->getPost())
        {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, "reply");
            $errors = $this->validation->getErrors();

            if(!$errors)
            {
                $reply = new \App\Entities\Reply();

                $reply->fill($data);

                $modelReply->save($reply);

                $segments = ['thread','view', $id_thread];

                $this->session->setFlashdata('success','Anda Berhasil Membuat Reply');

                return redirect()->to(base_url($segments));
            }

            $this->session->setFlashdata('errors', $errors);
        }

        return view('reply/create',[
            'thread' => $thread,
            'modelReply' => $modelReply
        ]);
    }

    public function edit()
    {
        $id = $this->request->uri->getSegment(3);

        $modelReply = new ReplyModel();
        $reply = $modelReply->find($id);

        $modelThread = new ThreadModel();
        $thread = $modelThread->find($reply->id_thread);

        if($this->request->getPost())
        {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, "reply");
            $errors = $this->validation->getErrors();

            if(!$errors)
            {
                $reply = new \App\Entities\Reply();

                $reply->fill($data);

                $modelReply->save($reply);

                $segments = ['thread','view', $reply->id_thread];

                $this->session->setFlashdata('success','Anda Berhasil Melakukan Edit Reply');

                return redirect()->to(base_url($segments));
            }

            $this->session->setFlashdata('errors', $errors);
        }


        return view('reply/edit',[
            'reply' => $reply,
            'thread' => $thread,
        ]);
    }

    public function uploadImages()
    {
        $validated = $this->validate([
            'upload' => [
                'uploaded[upload]',
                'mime_in[upload,image/jpg,image/jpeg,image/png]',
                'max_size[upload,1024]',
            ],
        ]);

        if($validated)
        {
            $file = $this->request->getFile('upload');
            $fileName = $file->getRandomName();
            $writePath = './reply';
            $file->move($writePath, $fileName);
            $data = [
                "uploaded" => true,
                "url" => base_url('reply/'.$fileName),
            ];
        }else{
            $data = [
                "uploaded" => false,
                "error" => [
                    "messsages" => $file
                ],
            ];
        }
        
        return $this->response->setJSON($data);
    }

    public function delete()
    {
        $id = $this->request->uri->getSegment(3);
        $id_thread = $this->request->uri->getSegment(4);

        $modelReply = new ReplyModel();

        $modelReply->delete($id);

        $segments = ['thread','view', $id_thread];

        $this->session->setFlashdata('success','Anda Berhasil Melakukan Delete Reply');

        return redirect()->to(base_url($segments));
    }
}
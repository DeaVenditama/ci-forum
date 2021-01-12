<?php namespace App\Controllers;
use \App\Models\ThreadModel;
use \App\Models\KategoriModel;
use \App\Models\UserModel;
use \App\Models\ReplyModel;

class Thread extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        $page = 1;

        if($this->request->getGet())
        {
            $page = $this->request->getGet('page');
        }

        $perPage = 20;

        $limit = $perPage;
        $offset = ($page-1)*$perPage;

        $modelThread = new ThreadModel();
        
        $threads = $modelThread->select('thread.id, thread.judul, kategori.kategori, user.nama ')
                    ->join('kategori', 'thread.id_kategori=kategori.id', 'left')
                    ->join('user', 'thread.created_by=user.id','left')
                    ->get($limit, $offset);

        $total = $modelThread->select('thread.id, thread.judul, kategori.kategori, user.nama ')
                    ->join('kategori', 'thread.id_kategori=kategori.id', 'left')
                    ->join('user', 'thread.created_by=user.id','left')
                    ->countAllResults();

        return view('thread/index',[
            'threads' => $threads,
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
        ]);
    }

    public function view()
    {
        $id = $this->request->uri->getSegment(3);

        $modelThread = new ThreadModel();
        $thread = $modelThread->find($id);

        $modelKategori = new KategoriModel();
        $kategori = $modelKategori->find($thread->id_kategori);

        $modelUser = new UserModel();
        $user = $modelUser->find($thread->created_by);

        $modelReply = new ReplyModel();
        $reply = $modelReply->select('reply.id, reply.isi, reply.created_at ,user.nama, user.avatar')
                    ->join('user','user.id=reply.id_user', 'left')
                    ->where('id_thread',$id)
                    ->get();

        return view('thread/view',[
            'thread' => $thread,
            'kategori' => $kategori,
            'user' => $user,
            'reply' => $reply,
        ]);
    }

    public function create()
    {
        $modelThread = new ThreadModel();

        if($this->request->getPost()){
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'thread');
            $errors = $this->validation->getErrors();

            if(!$errors)
            {
                $thread = new \App\Entities\Thread();

                $thread->fill($data);
                $thread->created_by = $this->session->get('id');
                $thread->created_at = date("Y-m-d H:i:s");

                $modelThread->save($thread);

                $id = $modelThread->insertID();

                $segments = ['thread','view',$id];

                $this->session->setFlashData('success',"Input Data Berhasil");

                return redirect()->to(base_url($segments));
            }

            $this->session->setFlashdata('errors',$errors);
        }

        $modelKategori = new KategoriModel();
        $kategori = $modelKategori->findAll();

        $arrayKategori = null;

        /**
         * [
         *  1=>Berita,
         *  2=>Teknologi,
         * ]
         */
        foreach($kategori as $k)
        {
            $arrayKategori[$k->id] = $k->kategori;
        }
         
        return view('thread/create',[
            'modelThread' => $modelThread,
            'arrayKategori' => $arrayKategori,
        ]);
    }

    public function update()
    {
        $id = $this->request->uri->getSegment(3);
        $modelThread = new ThreadModel();
        $thread = $modelThread->find($id);

        if($this->request->getPost()){
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'thread');
            $errors = $this->validation->getErrors();

            if(!$errors)
            {
                $thread = new \App\Entities\Thread();

                $thread->fill($data);
                $thread->updated_by = $this->session->get('id');
                $thread->updated_at = date("Y-m-d H:i:s");

                $modelThread->save($thread);

                $segments = ['thread','view',$id];

                $this->session->setFlashData('success',"Update Data Berhasil");

                return redirect()->to(base_url($segments));
            }

            $this->session->setFlashdata('errors',$errors);
        }

        $modelKategori = new KategoriModel();
        $kategori = $modelKategori->findAll();

        $arrayKategori = null;
        foreach($kategori as $k)
        {
            $arrayKategori[$k->id] = $k->kategori;
        }
         
        return view('thread/update',[
            'thread' => $thread,
            'arrayKategori' => $arrayKategori,
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
            $writePath = './threads';
            $file->move($writePath, $fileName);
            $data = [
                "uploaded" => true,
                "url" => base_url('threads/'.$fileName),
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

        $modelThread = new ThreadModel();

        $modelThread->delete($id);

        $this->session->setFlashdata('success', 'Delete Thread Berhasil');

        return redirect()->to(base_url('thread/index'));
    }
}
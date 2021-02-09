<?php namespace App\Controllers;
use \App\Models\MessagesModel;
use \App\Models\userModel;

class Messages extends BaseController
{
	public function __construct()
    {
        helper('form');
        $this->session = session();
    }

    public function create()
    {
        $id_recipient = $this->request->uri->getSegment(3);

        $modelMessages = new MessagesModel();
        $modelUser = new UserModel();

        $recipient = $modelUser->find($id_recipient);

        if($this->request->getPost())
        {
            $data = $this->request->getPost();
            $messages = new \App\Entities\Messages();

            $messages->fill($data);

            $modelMessages->save($messages);

            $segments = ['messages','outbox'];

            $this->session->setFlashdata('success','Kirim Pesan Berhasil');

            return redirect()->to(base_url($segments));
        }

        return view('messages/create',[
            'modelMessages' => $modelMessages,
            'recipient' => $recipient,
        ]);
    }

    public function inbox()
    {
        $modelMessages = new MessagesModel();
        $messages = $modelMessages
                    ->select('user.nama AS nama, messages.message AS message, messages.id AS messages_id')
                    ->join('user','user.id=messages.id_sender','left')
                    ->where('id_recipient',$this->session->get('id'))
                    ->findAll();

        return view('messages/inbox',[
            'messages' => $messages,
        ]);
    }

    public function outbox()
    {
        $modelMessages = new MessagesModel();
        $messages = $modelMessages
                    ->select('user.nama AS nama, messages.message AS message, messages.id AS messages_id')
                    ->join('user','user.id=messages.id_recipient','left')
                    ->where('id_sender',$this->session->get('id'))
                    ->findAll();

        return view('messages/outbox',[
            'messages' => $messages,
        ]);
    }

    public function view()
    {
        $id = $this->request->uri->getSegment(3);

        $userModel = new UserModel();

        $modelMessages = new MessagesModel();
        $messages = $modelMessages->find($id);
        if($messages->id_recipient==$this->session->id)
        {
            $messages->is_read = 1;
            $modelMessages->save($messages);
        }
        
        $recipient = $userModel->find($messages->id_recipient);
        $sender = $userModel->find($messages->id_sender);

        return view('messages/view',[
            'messages' => $messages,
            'recipient' => $recipient,
            'sender' => $sender,
        ]);
    }

}

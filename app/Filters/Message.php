<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Message implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $modelMessages = new \App\Models\MessagesModel();
        $message = $modelMessages->find($request->uri->getSegment(3));

        if(!$message)
        {
            return redirect()->to(base_url('home/index'));
        }

        if(session()->id!=$message->id_recipient && session()->id!=$message->id_sender)
        {
            return redirect()->to(base_url('home/index'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
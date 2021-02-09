<?php namespace App\Models;

use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_sender',
        'id_recipient',
        'message',
        'is_read',
        'created'
    ];
    protected $returnType = 'App\Entities\Messages';
    protected $useTimestamps = false;
}
<?php namespace App\Models;

use CodeIgniter\Model;

class ThreadModel extends Model
{
    protected $table = 'thread';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul',
        'isi',
        'id_kategori',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    protected $returnType = 'App\Entities\Thread';
    protected $useTimestamps = false;
}
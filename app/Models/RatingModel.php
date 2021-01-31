<?php namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'rating';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_thread',
        'id_user',
        'star'
    ];
    protected $returnType = 'App\Entities\Rating';
    protected $useTimestamps = false;
}
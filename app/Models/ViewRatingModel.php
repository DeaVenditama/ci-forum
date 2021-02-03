<?php namespace App\Models;

use CodeIgniter\Model;

class ViewRatingModel extends Model
{
    protected $table = 'view_rating';
    protected $allowedFields = [
        'id_thread',
        'sum_star',
        'count_star',
        'rating'
    ];
    protected $returnType = 'object';
}
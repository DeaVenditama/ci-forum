<?php namespace App\Controllers;
use \App\Models\ViewRatingModel;

class Home extends BaseController
{
	public function index()
	{
		$model = new ViewRatingModel();
		$top_thread = $model->select('thread.judul,view_rating.id_thread,view_rating.sum_star,view_rating.rating')
						->join('thread','thread.id=view_rating.id_thread','left')
						->orderBy('view_rating.rating','DESC')
						->orderBy('view_rating.sum_star','DESC')
						->get(10,0);

		return view('home',[
			'top_thread' => $top_thread,
		]);
	}

	//--------------------------------------------------------------------

}

<?php namespace App\Controllers;
use \App\Models\ThreadModel;
use \App\Models\UserModel;

class Dashboard extends BaseController
{
	public function index()
	{
		$modelThread = new ThreadModel();
        $modelUser = new UserModel();

        $jumlah_thread = $modelThread->countAllResults();
        $jumlah_user = $modelUser->countAllResults();

        $thread_per_kategori = $modelThread->select('COUNT(thread.id) AS jumlah, kategori.kategori AS kategori')
                                ->join('kategori','thread.id_kategori=kategori.id')
                                ->groupBy('thread.id_kategori')
                                ->get();

        $tahun_lahir_user = $modelUser->select('YEAR(tanggal_lahir) AS tahun_lahir, COUNT(id) AS jumlah')
                            ->groupBy('YEAR(tanggal_lahir)')
                            ->get();

        return view('dashboard/index',[
            'jumlah_thread' => $jumlah_thread,
            'jumlah_user' => $jumlah_user,
            'thread_per_kategori' => $thread_per_kategori,
            'tahun_lahir_user' => $tahun_lahir_user,
        ]);
 	}

	//--------------------------------------------------------------------

}

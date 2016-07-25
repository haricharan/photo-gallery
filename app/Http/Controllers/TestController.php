<?php 

namespace PhotoGallery\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use PhotoGallery\Jobs\CheckInputDisk;

class TestController extends Controller {
    
    use DispatchesJobs;

	/**
	 * Display a listing of the resource.
	 * GET /test
	 *
	 * @return Response
	 */
	public function index()
	{
		\Log::debug('TestController@index');
		return view('test1');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /test/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /test
	 *
	 * @return Response
	 */
	public function store()
	{
	    try {
	        \Log::debug('TestController@store');
	        $this->dispatch(new CheckInputDisk('input_image_disk', 'archive_image_disk'));
	        return view('test',['message' => 'Fired']);
	    } catch (Exception $e) {
	        \Log::error('Error in TestController@store');
	        \Log::error($e->getMessage());
	    }
	}

	/**
	 * Display the specified resource.
	 * GET /test/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /test/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /test/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /test/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
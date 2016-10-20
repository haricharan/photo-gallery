<?php 

namespace app\Http\Controllers;

use Illuminate\Routing\Controller;

class JobTestController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /jobtest
     *
     * @return Response
     */
    public function index()
    {
        return view('test')->render();
    }
}

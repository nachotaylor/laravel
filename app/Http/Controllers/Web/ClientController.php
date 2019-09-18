<?php

namespace App\Http\Controllers\Web;

use App\Repositories\Client\ClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class ClientController extends Controller
{
    protected $model;

    public function __construct(ClientRepository $client)
    {
        $this->model = $client;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('client.index', ['profile' => $this->model->profile(auth()->user()->id)]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->model->updateClient($request->all(), $id);
            return redirect()->back()->with('message', 'Cliente modificado.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

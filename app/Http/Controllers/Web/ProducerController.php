<?php

namespace App\Http\Controllers\Web;

use App\Repositories\Producer\ProducerRepository;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProducerController extends Controller
{
    protected $model;

    public function __construct(ProducerRepository $producer)
    {
        $this->model = $producer;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('producer.index', ['profile' => $this->model->profile(auth()->user()->id)]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->model->updateProducer($request->all(), $id);
            return redirect()->back()->with('message', 'Se han actualizado los datos correctamente.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

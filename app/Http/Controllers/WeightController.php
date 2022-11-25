<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWeightRequest;
use Illuminate\Http\Request;
use App\Models\Weight;

class WeightController extends Controller
{
    public function index()
    {
        return $this->success(null, [
            'data' => Weight::all()->toArray()
        ]);
    }

    public function create(CreateWeightRequest $request)
    {
        $weight = $request->getWeight();
        $weight->save();

        return $this->success('Weight created.', [
            'data' => $weight->id
        ]);
    }

    public function update(CreateWeightRequest $request)
    {
        $weight = Weight::findOrFail($request->get('weight_id'));
        $request->validated();
        $weight->update($request->all());

        return $this->success('Weight updated.', [
            'data' => $weight->id
        ]);
    }

    public function delete($id)
    {
        $weight = Weight::findOrFail($id);
        $weight->delete();

        return $this->success('Weight deleted.');
    }
}

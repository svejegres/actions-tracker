<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionStoreRequest;
use App\Models\Action;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  ActionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActionStoreRequest $request)
    {
        Action::create($request->validated());

        return redirect()->back()->with('success_message', __('Action saved'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActionStoreRequest  $request
     * @param  string  $actionId
     * @return \Illuminate\Http\Response
     */
    public function update(ActionStoreRequest $request, string $actionId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $actionId
     * @return \Illuminate\Http\Response
     */
    public function destroy($actionId)
    {
        Action::destroy($actionId);

        return response()->json(['success' => true]);
    }
}

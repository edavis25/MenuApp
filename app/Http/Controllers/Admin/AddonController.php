<?php

namespace App\Http\Controllers\Admin;

use App\Addon;
use App\AddonGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddonRequest;

class AddonController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddonRequest $request, $addon_group_id)
    {
        $group = AddonGroup::find($addon_group_id);
        $addon = new Addon([
            'name'    => $request->name,
            'price'   => $request->price ? $request->price * 100 : 0
        ]);
        $group->addons()->save($addon);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddonRequest $request, $id)
    {
        $addon = Addon::find($id);
        $addon->fill([
            'name'  => $request->name,
            'price' => $request->price ? $request->price * 100 : 0
        ]);
        $addon->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addon = Addon::find($id);
        $addon->delete();

        return redirect()->back();
    }
}

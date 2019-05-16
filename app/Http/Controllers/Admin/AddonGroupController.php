<?php

namespace App\Http\Controllers\Admin;

use App\AddonGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddonGroupRequest;
use App\MenuItem;
use Illuminate\Http\Request;

class AddonGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddonGroupRequest  $request
     * @param  int                                   $menu_item_id
     * @return \Illuminate\Http\Response
     */
    public function store(AddonGroupRequest $request, $menu_item_id)
    {
        $menu_item = MenuItem::find($menu_item_id);
        $menu_item->addonGroups()->save(new AddonGroup([
            'name'        => $request->name,
            'description' => $request->description,
            'required'    => $request->required ? true : false,
            'exclusive'   => $request->exclusive ? true : false
        ]));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddonGroupRequest $request, $id)
    {
        $group = AddonGroup::find($id);
        $group->fill([
            'name'        => $request->name,
            'description' => $request->description,
            'required'    => $request->required ? true : false,
            'exclusive'   => $request->exclusive ? true : false
        ]);

        $group->save();
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
        $group = AddonGroup::find($id);
        $group->delete();
        return redirect()->back();
    }
}

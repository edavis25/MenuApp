<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\MenuItem;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_items = MenuItem::all();

        return view('admin.menu-item.index', compact('menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get()->pluck('name', 'id');

        return view('admin.menu-item.edit', [
            'categories' => [null => 'Select Category'] + $categories->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuItemRequest $request)
    {
        $menu_item = MenuItem::create([
            'name'        => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price'       => $request->price * 100
        ]);

        return redirect()->route('admin.menu-item.edit', $menu_item->id);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu_item = MenuItem::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get()->pluck('name', 'id');

        return view('admin.menu-item.edit', [
            'menu_item'  => $menu_item,
            'categories' => [null => 'Select Category'] + $categories->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuItemRequest $request, $id)
    {
        $menu_item = MenuItem::find($id);
        $menu_item->fill([
            'name'        => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price'       => $request->price * 100
        ]);
       $menu_item->save();

       return redirect()->route('admin.menu-item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu_item = MenuItem::find($id);
        $menu_item->delete();

        return redirect()->back();
    }
}

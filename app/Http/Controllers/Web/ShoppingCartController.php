<?php

namespace App\Http\Controllers\Web;

use App\Addon;
use App\AddonGroup;
use App\Http\Controllers\Controller;
use App\MenuItem;
use App\OrderItem;
use App\ShoppingCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request, $menu_item_id)
    {
        /** The addon array's keys map to the group ids */
        $group_ids = array_keys($request->addons ?? []);

        /** The addon IDs are contained within arrays under each group id. Flatten them out into a single array */
        $addon_ids = collect($request->addons ?? [])->flatten();

        $shopping_item = new ShoppingCartItem($menu_item_id, $group_ids, $addon_ids);

        Session::push('cart', $shopping_item);

        return redirect()->back();
    }

    public function show()
    {
        $items = Session::get('cart') ?? [];

        return view('web.cart.show', compact('items'));
    }
}

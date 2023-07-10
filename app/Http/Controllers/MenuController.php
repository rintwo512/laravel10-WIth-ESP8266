<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function editMenus(User $user)
    {
        $title = "Update Menu";
        $menus = Menu::with('submenus')->get();
        $activeMenuIds = $user->menus()->pluck('id')->toArray();
        $activeSubMenuIds = $user->submenus()->pluck('id')->toArray();

        return view('menus.menuUpdate', compact('user', 'menus', 'activeMenuIds', 'activeSubMenuIds', 'title'));
    }

    public function updateMenus(Request $request, User $user)
{
    $menuStatuses = $request->input('menu_statuses');

    // Hapus semua asosiasi menu pengguna
    $user->menus()->detach();

    if (!is_null($menuStatuses)) {
        foreach ($menuStatuses as $menuId => $status) {
            if ($status == 1) {
                $user->menus()->attach($menuId, ['status' => $status]);
            }
        }
    }

    return redirect('/members')->with('success', 'Menu berhasil diperbarui untuk pengguna: ' . $user->name);
}






}











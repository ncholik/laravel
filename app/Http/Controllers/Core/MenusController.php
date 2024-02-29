<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Core\Menu;
use Spatie\Permission\Models\Role;

class MenusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus = Menu::orderBy('urut','ASC')->get();
        return view('menu.index', compact('menus'));
    }

    public function create() 
    {
        $menus = Menu::where('parent_id',0)->orderBy('urut','ASC')->get();
        $roles = Role::latest()->get();
        return view('menu.create', compact('menus','roles'));
    }

    public function simpan(Request $request) 
    {
        $request->validate([
            'menu' => 'required',
        ]);
        $array_menu = json_decode($request->menu, true);
        $this->saveMenu($array_menu);
        $menus = Menu::orderBy('urut','ASC')->get();
        return view('menu.index', compact('menus'));
    }

    private function saveMenu($menu, $parent_id=0){
        $urut=1;
        foreach($menu as $m){            
            $dm = Menu::where('id',$m['id'])->first();
            if($dm){
                $dm->urut=$urut;
                $dm->parent_id=$parent_id;
                $dm->save();
            }
            if(isset($m['children']) && count($m['children'])>0){
                $this->saveMenu($m['children'], $m['id']);
            }
            $urut++;
        }
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'can' => 'required',
            'icon' => 'required',
        ]);
       
        $active="";
        if($request->url!="")$active=serialize([$request->url,$request->url."*"]);
        $menu = Menu::create([
            'label' => $request->name,
            'url' => $request->url,
            'can' => serialize($request->can),
            'icon' => $request->icon,
            'urut' => 1,
            'parent_id' => $request->parent_id,
            'active' => $active,
        ]);

        return redirect()->route('menus.index')
                ->with('success_message', 'Berhasil menambah menu');
    }

    public function edit($menu)
    {
        $menu = Menu::where('id',$menu)->first();
        if($menu){
            $menus = Menu::where('parent_id',0)->orderBy('urut','ASC')->get();
            return view('menu.edit', [
                'menu' => $menu,
                'menus' => $menus,
                'roles' => Role::latest()->get()
            ]);
        }else 
            return redirect()->route('menus.index')
                ->with('success_message', 'Berhasil menambah menu');
    }
    

    public function update(Request $request, $menu)
    {
        $request->validate([
            'name' => 'required',
            'can' => 'required',
            'icon' => 'required',
        ]);
        $active="";
        if($request->url!="")$active=serialize([$request->url,$request->url."*"]);
        $menu = Menu::where('id',$menu)->first();
        if($menu){
            $menu->label = $request->name;
            $menu->url= $request->url;
            $menu->can= serialize($request->can);
            $menu->icon= $request->icon;
            $menu->urut= 1;
            $menu->parent_id= $request->parent_id;
            $menu->active= $active;
            $menu->save();
        }
        return redirect()->route('menus.index')
                ->with('success_message', 'Berhasil merubah menu');
    }

    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect()->route('menus.index')
        ->with('success_message', 'Berhasil menghapus menu');
    }
}

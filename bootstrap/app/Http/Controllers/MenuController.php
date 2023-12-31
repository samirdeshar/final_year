<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Str;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Support\ImageSupport;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $menu = null;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }
    public function index(Request $request)
    {

        if ($request->user()->can("view-menu")) {
            $menu_items = Menu::orderBy('position', 'asc')->whereIn('header_footer', ['1', '3'])->get();
            $menu_footer = Menu::orderBy('position', 'asc')->whereIn('header_footer', ['2', '3'])->get();
            return view('admin.menu.index', compact('menu_items', 'menu_footer'));
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->can("create-menu")) {
            $menu_categories = MenuCategory::latest()->get();
            // dd($menu_categories);
            $parent_menus = Menu::where('parent_id', null)->get();
            return view('admin.menu.create', compact('menu_categories', 'parent_menus'));
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->user()->can("create-menu")) {
            $this->validate($request, [
                'name' => 'required',
                'menu_category' => 'required',
                'page_title' => 'nullable',
                'main_child' => 'required',
                'parent_id' => '',
                'show_in' => '',
                'image' => 'nullable',
                'banner_image' => 'required',
                'meta_title'  => '',
                'meta_keywords'  => '',
                'meta_description'  => '',
                'og_image' => 'nullable',
                'title_slug' => 'nullable',
                'content_slug' => 'nullable'

            ]);


            $image = $request->banner_image;

            $parent_id = NULL;
            $show_in = 1;


            if ($request['main_child'] == 1) {
                $parent_id = $request['parent_id'];
            } else if ($request['main_child'] == 0) {
                $show_in = $request['show_in'];
            }

            $menu_count = Menu::all()->count();            
            $new_menu = Menu::create([
                'name' => $request['name'],
                'slug' => Str::slug($request->name),
                'image' => $request['image'],
                'banner_image' => $image,
                'og_image' => $request['og_image'],
                'position' => $menu_count + 1,
                'category_slug' => $request['menu_category'],
                'main_child' => $request['main_child'],
                'parent_id' => $parent_id,
                'external_link' => $request['external_link'],
                'header_footer' => $show_in,
                'publish_status' => $request->publish_status ?? 0,
                'page_title' => $request['page_title'],
                'title_slug' => Str::slug($request->page_title),
                'content_slug' => $request['content_slug'],
                'content' => $request['content'],
                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],

            ]);            
        // $input = $request->all();
            // return $new_menu;

            // $new_menu->save();

            Toastr::success('Succesfully Saved.', 'Success !!!');
            return redirect()->route('menu.index');
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if ($request->user()->can("edit-menu")) {
            $menu = Menu::findorFail($id);

            // return $menu;
            $menu_categories = MenuCategory::latest()->get();
            $parent_menus = Menu::where('parent_id', null)->get();
            return view('admin.menu.edit', compact('menu', 'menu_categories', 'parent_menus'));
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->user()->can("edit-menu")) {
            $this->validate($request, [
                'name' => 'required',
                'menu_category' => 'required',
                'page_title'=>'nullable',
                'main_child' => 'required',
                'parent_id' => '',
                'show_in' => '',
                'image' => 'nullable',
                'banner_image' => 'nullable',
                'meta_title'  => '',
                'meta_keywords'  => '',
                'meta_description'  => '',
                'og_image' => 'nullable',
                'content_slug' => 'nullable'
            ]);

            $menu = Menu::findorFail($id);

            $parent_id = NULL;
            $show_in = 1;
            if ($request['main_child'] == 1) {
                $parent_id = $request['parent_id'];
            } else if ($request['main_child'] == 0) {
                $show_in = $request['show_in'];
            }        

            $menu->update([
                'name' => $request['name'],
                'slug' => Str::slug($request->name),
                'category_slug' => $request['menu_category'],
                'image' => $request['image'],
                'banner_image' => $request['banner_image'],
                'og_image' => $request['og_image'],
                'main_child' => $request['main_child'],
                'parent_id' => $parent_id,
                'external_link' => $request['external_link'],
                'header_footer' => $show_in,
                'title_slug' => $request['title_slug'],
                'content_slug' => $request['content_slug'],
                'title_slug' => Str::slug($request->page_title),
                'content' => $request['content'],
                'meta_title' => $request['meta_title'],
                'publish_status' => $request->publish_status ?? 0,
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
            ]);

            Toastr::success('Succesfully Updated.', 'Success !!!');
            return redirect()->route('menu.index');
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        if ($request->user()->can("remove-menu")) {

            $menu = Menu::findorFail($id);

            $child_menus = Menu::where('parent_id', $menu->id)->get();

            if (count($child_menus) > 0) {
                Toastr::warning('Please Delete Child menu before Delete It.', 'Child Menu !!!');
                return back();
            } else {
                $menu->delete();
                Toastr::success('Succesfully deleted.', 'Deleted !!!');
                return redirect()->route('menu.index');
            }
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    // public function menuLinkCourse()
    // {
    //     return Course::forMenu()->select('id','slug','title')->get();
    // }

    public function updateMenuOrder(Request $request)
    {
        if ($request->user()->can("edit-menu")) {
            parse_str($request->sort, $arr);
            $order = 1;
            if (isset($arr['menuItem'])) {
                foreach ($arr['menuItem'] as $key => $value) {  //id //parent_id
                    $this->menu->where('id', $key)
                        ->update([
                            'position' => $order,
                            'parent_id' => ($value == "null") ? NULL : $value,
                            'main_child' => ($value == "null") ? 0 : 1,
                        ]);
                    $order++;
                }
            }
            return true;
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    private function update_child(Request $request, $id)
    {
        if ($request->user()->can("edit-menu")) {
            $menus = Menu::where('parent_id', $id)->get();
            if ($menus->count() > 1) {
                foreach ($menus as $child) {
                    Menu::where('id', $child->id)->update(['parent_id' => $child->id]);
                    $this->update_child($child->id);
                }
                // $this->forgetMenuCache();
            }
        } else {
            Toastr::warning("You can't See this Page.", "Not Authorized !!!");
            return back();
        }
    }

    public function create_menuCategory(Request $request)
    {
        $menuCategory = MenuCategory::create([
            'name' => $request['name'],
            'slug' => Str::slug($request->name),
        ]);
        $menuCategory->save();
    }
}

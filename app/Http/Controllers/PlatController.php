<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlatRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Plat;
use App\Models\User;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $plats = Plat::all();
        $plats = Plat::paginate(10);

        return view('plats.index',compact('plats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlatRequest $request)
    {
        // $request->validate([
        //     'nom_menu' => 'required',
        //     'description_menu' => 'required',
        //     'date_menu' => ['date', 'required', Rule::unique('plats')->where(function ($query) {
        //         return $query->where('date_menu', '>', now());
        //     })],
        //     'image_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);

        $plat = new Plat;

        $plat->nom_menu         = $request->nom_menu;
        $plat->description_menu = $request->description_menu;
        $plat->date_menu        = $request->date_menu;
        $image                  = $request->file('image_menu');
        
        if(!empty($image)){
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $plat->image_menu = $new_name;
        }else{
            $plat->image_menu = $image;
        }
        $plat->save();

        return redirect()->route('plats.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plat = Plat::find($id);
        return view('plats.show', compact('plat'));
    }

    // landing page
    public function welcome()
    {
        // $plats = Plat::all();
        $plats = Plat::paginate(8);
        return view('index', compact('plats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plat = Plat::findOrFail($id);
        return view('plats.edit', compact('plat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(StorePlatRequest $request, $id)
    {
        // $request->validate([
        //     'nom_menu' => 'required',
        //     'description_menu' => 'required',
        //     'date_menu' => ['date', 'required'],
        //     'image_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
     
        $plat = Plat::findOrFail($id);
        $image = $request->file('image_menu');
    
        if ($image) {
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $plat->image_menu   = $new_name;
        }
    
        $plat->nom_menu         = $request->nom_menu;
        $plat->description_menu = $request->description_menu;
        $plat->date_menu        = $request->date_menu;
    
        $plat->update();
    
        return redirect()->route('plats.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plat = Plat::findOrFail($id);
        $plat->delete();
    
        return redirect()->route('plats.index');
    }

    public function dash()
    {
        $plats = Plat::count();
        $users = User::count();
        return view('/dashboard', compact('plats','users'));
    }


}

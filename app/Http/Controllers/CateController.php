<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $models = Cate::where('user_id',$user->id)->get();
        return view('cate',['models'=> $models]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required'
        ]);
        $model = new Cate();
        $model->user_id = Auth::user()->id;
        $model->name = $request->name;
        $model->save();
        return redirect()->back()->with("Ma'lumot qo'shildi ");
    }
    public function edit(Request $request, Cate $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required'
        ]);
        $id->name = $request->name;
        $id->save();
        return redirect()->back()->with("Ma'lumot o'zgartirildi !");
    }
    public function delete(Cate $id)
    {
        $id->delete();
        return redirect()->back()->with("Ma'lumot o'chirildi !");
    }
}

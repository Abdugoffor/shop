<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Tavar;
use App\Models\Zakaz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TavarController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $productdata = DB::table('tavars')->select(DB::raw('SUM(soni*narx1) as amount'))->get();
        $foyda = DB::table('tavars')->select(DB::raw('SUM(soni*(narx2-narx1)) as amount'))->get();

        $models = Tavar::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);
        $cates = Cate::where('user_id', $user->id)->get();
        return view('tavar', ['models' => $models, 'cates' => $cates, 'foyda' => $foyda, 'productdata' => $productdata]);
    }
    public function store(Request $request)
    {
        // dd();
        $request->validate([
            'name' => 'required',
            'brend' => 'required',
            'img' => 'mimes:jpg,png',
            'cate_id' => 'required|integer',
            'narx1' => 'required|integer',
            'narx2' => 'required|integer',
            'soni' => 'required|integer',
        ]);

        $model = new Tavar();

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . Str::random(40) . '.' . $extensions;
            $file->move('uploded/', $filename);
            $model->img = 'uploded/' . $filename;
        } else {
            $model->img = '1.jpg';
        }

        $model->name = $request->name;
        $model->brend = $request->brend;
        $model->user_id = Auth::user()->id;
        $model->cate_id = $request->cate_id;
        $model->active = 0;
        $model->narx1 = $request->narx1;
        $model->narx2 = $request->narx2;
        $model->soni = $request->soni;
        $model->foyda = $request->soni * ($request->narx2 - $request->narx1);
        $model->save();
        return redirect()->back()->with("Ma'lumot qo'shildi ");
    }
    public function edit(Request $request, Tavar $id)
    {
        // dd($request->file);
        $request->validate([
            'name' => 'required',
            'brend' => 'required',
            'img' => 'mimes:jpg,png',
            'cate_id' => 'required|integer',
            'narx1' => 'required|integer',
            'narx2' => 'required|integer',
            'soni' => 'required|integer',
        ]);

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extensions = $file->getClientOriginalExtension();
            $filename = time() . Str::random(40) . '.' . $extensions;
            $file->move('uploded/', $filename);
            $id->img = 'uploded/' . $filename;
        }

        $id->name = $request->name;
        $id->brend = $request->brend;
        $id->cate_id = $request->cate_id;
        $id->narx1 = $request->narx1;
        $id->narx2 = $request->narx2;
        $id->soni = $request->soni;
        $id->foyda = $request->soni * ($request->narx2 - $request->narx1);
        $id->save();
        return redirect()->back()->with("Ma'lumot o'zgartirildi !");
    }
    public function delete(Tavar $id)
    {
        $zakaz = Zakaz::where('tavar_id', $id->id)->delete();
        $id->delete();
        return redirect()->back()->with("Ma'lumot o'chirildi !");
    }
    public function cart()
    {
        $user = Auth::user();
        $models = Tavar::where('user_id', $user->id)->where('active', 1)->where('soni', '>', 0)->orderBy('created_at', 'desc')->get();
        return view('cart', ['models' => $models]);
    }
    public function search(Request $request)
    {
        $user = Auth::user();
        $request->validate(['text' => 'required']);

        $models = Tavar::where('user_id', $user->id)
            ->where('name', 'LIKE', '%' . $request->text . '%')
            ->orWhere('narx1', 'LIKE', '%' . $request->text . '%')
            ->orWhere('narx2', 'LIKE', '%' . $request->text . '%')->get();

        return view('cart', ['models' => $models]);
    }
    public function addcart(Tavar $product)
    {
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'narx' => $product->narx2,
                    'soni' => 1,
                    'max' => $product->soni,
                    'img' => $product->img,
                ],
            ];
            session()->put('cart', $cart);
            return redirect()->route('cart');
        }

        if (isset($cart[$product->id]) and $cart[$product->id]['soni'] < $product->soni) {
            $cart[$product->id]['soni']++;
            session()->put('cart', $cart);
            return redirect()->route('cart');
        } elseif (isset($cart[$product->id]) and $cart[$product->id]['soni'] <= $product->soni) {
            return redirect()->back();
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'narx' => $product->narx2,
            'soni' => 1,
            'max' => $product->soni,
            'img' => $product->img,
        ];
        session()->put('cart', $cart);
        return redirect()->back();
    }
    public function soni(Request $request, Tavar $product)
    {
        $cart = session()->get('cart');
        if ($request->change == 'down') {
            if ($cart[$product->id]['soni'] > 1) {
                $cart[$product->id]['soni']--;
                session()->put('cart', $cart);
                return redirect()->route('cart');
            } else {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
                return redirect()->route('cart');
            }
        } elseif ($request->change == 'top') {
            if ($cart[$product->id]['soni'] < $product->soni) {
                $cart[$product->id]['soni']++;
                session()->put('cart', $cart);
                return redirect()->route('cart');
            } else {
                return redirect()->route('cart');
            }
        } else {
            return redirect()->route('cart');
        }
    }
    public function chakout()
    {
        // if (session('cart')) {
        //     foreach (session('cart') as $id => $product) {
        //         echo $cart[$id];
        //     }
        // }
        // dd($cart = session()->get('cart'));
    }
    public function deletecart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }
}

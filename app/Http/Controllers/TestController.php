<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Tavar;
use App\Models\Zakaz;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = session()->get('cart');
        if (!empty($cart)) {
            foreach ($cart as $id => $product) {

                $tavar = Tavar::find($id);
                $tavar->soni = $tavar->soni - $product['soni'];
                $tavar->save();

                $models = new Zakaz();
                $models->user_id = $user->id;
                $models->tavar_id = $id;
                $models->soni = $product['soni'];
                $models->sum = $product['narx'] * $product['soni'];
                $models->save();
            }
        }

        session()->forget('cart');
        return redirect()->back()->with('text', 'Malumot saqlandi ! ');
    }
    public function activ(Tavar $id)
    {
        if ($id->active == 0) {
            $id->active = 1;
        } elseif ($id->active == 1) {
            $id->active = 0;
        }
        $id->save();
        return redirect()->back()->with('text', 'Malumot saqlandi ! ');
    }
    public function dash()
    {
        $user = Auth::user();
        $cates = Cate::where('user_id', $user->id)->get();
        $models = Tavar::where('user_id', $user->id)->paginate(20);
        $zakaz = Zakaz::where('user_id', $user->id)->sum('soni');

        return view('dash', ['models' => $models, 'zakazs' => $models, 'zakaz' => $zakaz, 'cates' => $cates]);
    }
    public function xisob($key)
    {
        $user = Auth::user();

        $models = Tavar::where('user_id', $user->id)->get();
        $zakaz1 = Zakaz::where('user_id', $user->id)->sum('soni');
        $cates = Cate::where('user_id', $user->id)->get();
        if ($key == 1) {

            $modelsd = Tavar::where('user_id', $user->id)->where('soni', '>', 0)->orderBy('created_at', 'desc')->paginate(20);
            return view('dash', ['zakazs' => $modelsd, 'zakaz' => $zakaz1, 'models' => $models, 'cates' => $cates]);
        } elseif ($key == 2) {

            // $zakazs = Zakaz::where('user_id', $user->id)->groupBy('tavar_id')
            //     ->selectRaw('sum(soni) as yigindi, tavar_id')
            //     ->selectRaw('sum(sum) as test, tavar_id')->with('tavar')
            //     ->get();
            $zakazs = Zakaz::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
            return view('dash1', ['models' => $models, 'zakaz' => $zakaz1, 'zakazs' => $zakazs]);
        } elseif ($key == 3) {

            $modelsd = Tavar::where('user_id', $user->id)->where('soni', '<', 10)->orderBy('created_at', 'desc')->paginate(20);
            return view('dash', ['models' => $models, 'zakaz' => $zakaz1, 'zakazs' => $modelsd, 'cates' => $cates]);
        } elseif ($key == 4) {

            $modelsd = Tavar::where('user_id', $user->id)->where('soni', 0)->orderBy('created_at', 'desc')->paginate(20);
            return view('dash', ['models' => $models, 'zakaz' => $zakaz1, 'zakazs' => $modelsd, 'cates' => $cates]);
        } else {
            return redirect()->back();
        }
    }
    public function date(Request $request)
    {
        $user = Auth::user();

        $models = Tavar::where('user_id', $user->id)->get();
        $zakaz1 = Zakaz::where('user_id', $user->id)->sum('soni');

        $request->validate([
            'date1' => 'required',
            'date2' => 'required',
        ]);
        $start = $request->date1;
        $end = $request->date2;
        $date1 = date_create($request->date1);
        $date2 = date_create($request->date2);
        $diff = date_diff($date1, $date2);
        if ($diff->format("%R%a") >= 0) {
            $zakazs = Zakaz::where('user_id', $user->id)->whereDate('created_at', '>=', $date1)
            ->whereDate('created_at', '<=', $date2)->orderBy('created_at', 'desc')->get();
        }


        return view('dash2', ['models' => $models, 'zakaz' => $zakaz1, 'zakazs' => $zakazs]);
    }
}

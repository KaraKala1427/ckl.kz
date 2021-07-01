<?php


namespace App\Http\Controllers;



use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetController
{

    public function passwordEdit()
    {
        if (Auth::user()) {
            $menu = Menu::orderBy('orderid')->orderBy('level')->get();
            return view('admin.password', compact('menu'));

        } else {

            return redirect()->back();
        }

    }


    public function passwordUpdate(Request $request)
    {

        $validate = $request->validate(
            [
                'oldPassword' => 'required|min:8',
                'password' => 'required|min:8|confirmed',

            ]);

        $user = User::find(Auth::user()->id);

        if ($user) {
            if (Hash::check($request['oldPassword'], $user->password) && $validate) {
                $user->password = Hash::make($request['password']);

                $user->save();

                $request->session()->flash('success', 'Ваши данные были успешно изменены!');
                return redirect()->back();

            } else {

                $request->session()->flash('error', 'Неверные данные');
                return redirect()->route('admin.password.edit');

            }

        }
    }
}


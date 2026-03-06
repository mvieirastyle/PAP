<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showList()
    {
        $users = User::all();
        return view('pages.admin.users.list', [
            'users' => $users,
        ]);
    }

    public function Showadd()
    {
        $users = User::all();
        return view('pages.admin.users.add', [
            'users' => $users,
        ]);
    }

    public function add(UserRequest $request)
    {

        $request->validated();
   
        User::createNewAdmin($request->all());

        return redirect('/admin/users/list')->with('success', 'Utilizador adicionado com sucesso');
    }


    public function showEdit(int $id)
    {
        $user = User::all()->find($id);
        return view('pages.admin.users.edit', [
            'user' => $user,
        ]);
    }


    public function update(UpdateRequest $request, int $id)
    {
        User::findOrFail($id);
        $request->validated();

       User::updateUser( $id, $request->all());

        if (Auth::user()->admin) {
            return redirect('/admin/users/list')->with('success', 'Utilizador editado com sucesso');
        } else {
            return redirect('/profile')->with('success', 'Suas informações foram atualizadas com sucesso');
        }
    }

    public function delete($id)
    {
        User::deleteUser($id);

        return redirect('/admin/users/list')->with('success', 'Utilizador removido com sucesso');
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('pages.profile', [
            'user' => $user,
        ]);
    }
}

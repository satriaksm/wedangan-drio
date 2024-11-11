<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        //get all users
        $users = User::latest()->paginate(10);

        //render view with users
        return view('pages.user.index', compact('users'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.user.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'img' => $request->file('img')->store('images/users', 'public'),
            'role' => 2, // Set role to cashier by default
        ]);

        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data saved successfully']);
    }


    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get user by ID
        $users = User::findOrFail($id);

        //render view with user
        return view('pages.user.edit', compact('users'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|confirmed|min:8',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        //get user by ID
        $user = User::findOrFail($id);

        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 2, // Set role to cashier by default
        ];

        if ($request->hasFile('img')) {
            //delete old image
            if ($user->img) {
                Storage::disk('public')->delete($user->img);
            }
            //store new image
            $data['img'] = $request->file('img')->store('images/users', 'public');
        }

        $user->update($data);

        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get user by ID
        $user = User::findOrFail($id);

        //delete user
        $user->delete();

        //redirect to index
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%{$search}%")
            ->paginate(10);

        return view('pages.user.index', compact('users'));
    }
}

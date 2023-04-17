<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $users = User::query();

        // get the search value from the request
        $search = $request->input('search');

        // search the users by name or email
        $users->when($request->input('search'), function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });

        return view('admin.user.index', [
            'users' => $users->paginate()->withQueryString(),
        ]);
    }
}

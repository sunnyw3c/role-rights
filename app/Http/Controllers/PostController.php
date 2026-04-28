<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // anyone logged in can view posts
    public function index()
    {
        return view('posts.index');
    }

    // Only users with 'create posts' permission can see create form
    public function create()
    {
        if (!auth()->user()->can('create posts')) {
            abort(403, 'You do not have permission to create posts.');
        }
        return view('posts.create');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('edit posts')) {
            abort(403, 'You do not have permission to edit posts.');
        }
    }


    public function destroy($id)
    {
        if (!auth()->user()->can('delete posts')) {
            abort(403, 'You do not have permission to delete posts.');
        }

        return 'Post ID ' . $id . ' deleted successfully - direct permission worked!';
    }


    // Only users with 'manage users' permission can access this

    public function manageUsers()
    {
        if (!auth()->user()->can('manage users')) {
            abort(403, 'You do not have permission to manage users.');
        }
    }
}

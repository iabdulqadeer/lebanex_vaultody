<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Vaultody\Callbacks;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class VaultodyCallback extends Controller
{
    public function index(Request $request) {
        Callbacks::create([
            'callback_content' => json_encode($request->all())
        ]);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Exception;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('borrowings')->get();
        return view('members.index', compact('members'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:members,email',
                'membership_id' => 'required|string|unique:members,membership_id'
            ]);

            $validated['max_borrows'] = 3; // Default max borrows

            Member::create($validated);

            return redirect('/members')->with('success', 'Member registered successfully!');
        } catch (Exception $e) {
            return redirect('/members')->with('error', 'Error registering member: ' . $e->getMessage());
        }
    }
}

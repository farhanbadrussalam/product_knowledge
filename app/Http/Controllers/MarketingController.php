<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

use DataTables;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.marketing.index', [
            'title' => 'Data Marketing',
            'template' => 'admin'
        ]);
    }

    public function dataAjax()
    {
        $users = User::all();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '
                        <div class="d-flex justify-content-center w-100">
                            <a href="' . url("dashboard/marketing/$user->id") . '" class="badge bg-info me-2">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                            <a href="' . url("dashboard/marketing/$user->id/edit") . '" class="badge bg-warning me-2">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0)" onclick="deleteThis(' . $user->id . ')" class="badge bg-danger">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </div>
                    ';
            })
            ->addColumn('updated', function ($user) {
                return $user->updated_at->diffForHumans();
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marketing.create', [
            'title' => 'Tambah marketing',
            'template' => 'Tambah'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email:dns',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        User::create($validatedData);

        return redirect('/dashboard/marketing')->with('success', 'Create new marketing success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.marketing.edit', [
            'title' => 'Edit marketing',
            'template' => 'Edit',
            'marketing' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email:dns'
        ]);

        // $user = User::find($id);

        // if(Hash::check($request->password_lama, $user->password)){

        //     $validatedData['password'] = Hash::make($validatedData['password']);
        // }else{

        // }
        User::where('id', $id)
            ->update($validatedData);
        return redirect('/dashboard/marketing')->with('success', 'Update marketing success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return 'Marketing has been deleted';
    }
}

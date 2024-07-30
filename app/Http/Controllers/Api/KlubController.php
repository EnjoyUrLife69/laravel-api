<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Klub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KlubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klub = Klub::Latest()->get();
        $res = [
            'success' => true,
            'message' => "Daftar Klub Sepak Bola",
            'data' => $klub,
        ];
        return response()->json($res, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_club' => 'required|unique:klubs',
            'logo' => 'required|image',
            'id_liga' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $path = $request->file('logo')->store('public/logo');
            $klub = new Klub();
            $klub->nama_club = $request->nama_club;
            $klub->logo = $path;
            $klub->id_liga = $request->id_liga;
            $klub->save();
            return response()->json([
                'success' => true,
                'message' => 'Klub created successfully',
                'data' => $klub,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error processing your request',
                'errors' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $klub = Klub::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Detail klub',
                'data' => $klub,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ada',
                'errors' => $e->getMessage(),
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validate = Validator::make($request->all(), [
            'nama_club' => 'required|unique:klubs',
            'logo' => 'required|image|max:2048',
            'id_liga' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $klub = Klub::findOrFail($id);

            if ($request->hasFile('logo')) {
                //delete poto / logo lama
                Storage::delete($klub->logo);
                $path = $request->file('logo')->store('public/logo');
                $klub->logo = $path;
            }

            $klub->nama_club = $request->nama_club;
            $klub->id_liga = $request->id_liga;
            $klub->save();
            return response()->json([
                'success' => true,
                'message' => 'Klub created successfully',
                'data' => $klub,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error processing your request',
                'errors' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $klub = Klub::findOrFail($id);
            Storage::delete($klub->logo); //menghapus gambar lama / foto lama
            $klub->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data ' . $klub->nama_club . ' Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ada',
                'errors' => $e->getMessage(),
            ], 404);
        }

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Liga;

class LigaController extends Controller
{
    public function index()
    {
        $liga = Liga::Latest()->get();
        $res = [
            'success' => true,
            'message' => "Daftar Liga Sepak Bola",
            'data' => $liga,
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' => 'required|unique:ligas',
            'negara' => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $liga = new Liga();
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save();
            return response()->json([
                'success' => true,
                'message' => 'Liga created successfully',
                'data' => $liga
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error processing your request',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $liga = Liga::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Detail Liga',
                'data' => $liga,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ada',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' => 'required',
            'negara' => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $liga = Liga::findOrFail($id);
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save();
            return response()->json([
                'success' => true,
                'message' => 'Liga created updated successfully',
                'data' => $liga
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error processing your request',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $liga = Liga::findOrFail($id);
            $liga->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data' . $liga->nama_liga . 'Data Deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ada',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
}
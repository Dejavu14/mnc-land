<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResidanceResource;
use App\Models\Residance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResidanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Residance::latest()->get();
        return response()->json([
            'data' => ResidanceResource::collection($posts),
            'message' => 'Fetch all posts',
            'success' => true
        ]);
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
        $validator = Validator::make($request->all(), [
            'residential_name' => 'required|string|max:155',
            'unit_number' => 'required',
            'type_residential' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $post = Residance::create([
            'residential_name' => $request->get('residential_name'),
            'unit_number' => $request->get('unit_number'),
            'type_residential' => $request->get('type_residential'),
            'description' => $request->get('description')
            // 'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json([
            'data' => new ResidanceResource($post),
            'message' => 'Post created successfully.',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Residance  $residance
     * @return \Illuminate\Http\Response
     */
    public function show(Residance $residance)
    {
        return response()->json([
            'data' => new ResidanceResource($residance),
            'message' => 'Data post found',
            'success' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Residance  $residance
     * @return \Illuminate\Http\Response
     */
    public function edit(Residance $residance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Residance  $residance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Residance $residance)
    {
        $validator = Validator::make($request->all(), [
            'residential_name' => 'required|string|max:155',
            'unit_number' => 'required',
            'type_residential' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }

        $residance->update([
            'residential_name' => $request->get('residential_name'),
            'unit_number' => $request->get('unit_number'),
            'type_residential' => $request->get('type_residential'),
            'description' => $request->get('description')
            // 'slug' => Str::slug($request->get('title'))
        ]);

        return response()->json([
            'data' => new ResidanceResource($residance),
            'message' => 'Post updated successfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Residance  $residance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Residance $residance)
    {
        $residance->delete();

        return response()->json([
            'data' => [],
            'message' => 'Post deleted successfully',
            'success' => true
        ]);
    }
}

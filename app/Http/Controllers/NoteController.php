<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(): JsonResponse
    {
        //$notes = Note::all();
        //return response()->json($notes,200);
        //return response()->json(Note::all(),200);
        return response()->json(NoteResource::collection(Note::all()));
    }

    public function store(NoteRequest $request):JsonResponse
    {
        $note = Note::create($request->all());
        return response()->json([
            'data' => new NoteResource($note),
            'success' => true
        ], 201);
    }


    public function show($id):JsonResponse
    {
        $note = Note::find($id);
        return response()->json($note,200);
    }

    public function update(Noterequest $request, $id):JsonResponse
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return response()->json([
            'data' => new NoteResource($note),
            'success' => true
        ], 200);
    }

    public function destroy($id):JsonResponse
    {
        Note::find($id)->delete();
        return response()->json([
            'success' => true
        ],200);
    }
}

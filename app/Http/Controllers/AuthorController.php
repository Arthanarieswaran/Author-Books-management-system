<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Author;
use Illuminate\Http\Request;
use Validator;

class AuthorController extends BaseController
{
    public function index(Request $request)
    {
        $author = Author::with('books')->orderBy('id', 'desc')->get();

        return $this->sendResponse($author, 'Authors list fetched successfully.');

    }

    public function show(string $id)
    {
        $author = Author::where('id', $id)->with('books')->orderBy('id', 'desc')->first();

        return $this->sendResponse($author, 'Author details fetched successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:50',
            'email'             => 'required|email|unique:authors,email',
            'bio'               => 'required|string|max:100',
            'country'           => 'required|string',
            'is_active'         => 'required|boolean',
            'last_published_at' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $author = Author::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'bio'               => $request->bio,
            'country'           => $request->country,
            'is_active'         => $request->is_active,
            'last_published_at' => $request->last_published_at,
        ]);

        // Need to fire the websocket

        return $this->sendResponse($author, "Author details created successfully", 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:50',
            'email'             => 'required|email|unique:authors,email,' . $id,
            'bio'               => 'required|string|max:100',
            'country'           => 'required|string',
            'is_active'         => 'required|boolean',
            'last_published_at' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $author = Author::findOrFail($id);

        $author->update($request->all());

        // Need to call the websocket

        return $this->sendResponse($author, "Author details updated successfully");

    }

    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (! $author) {
            return $this->sendError('Author not found');
        }

        $author->delete();
        return $this->sendResponse('Success', 'Author deleted successfully');

    }
}

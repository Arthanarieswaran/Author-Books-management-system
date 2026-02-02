<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Books;
use Illuminate\Http\Request;
use Validator;

class BookController extends BaseController
{
    public function index(Request $request)
    {
        $books = Books::with('author')->orderBy('id', 'desc')->get();

        return $this->sendResponse($books, "Books details fetched successfully");
    }

    public function show(string $id)
    {
        $books = Books::where('id', $id)->with('author')->orderBy('id', 'desc')->first();

        return $this->sendResponse($books, "Book details fetched successfully");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id'      => 'required|integer',
            'title'          => 'required|string|max:255',
            'published_year' => 'required|integer',
            'language'       => 'required|string|max:50',
            'pages'          => 'required|integer',
            'summary'        => 'required|string|max:500',
            'is_available'   => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $books = Books::create([
            'author_id'      => $request->author_id,
            'title'          => $request->title,
            'published_year' => $request->published_year,
            'language'       => $request->language,
            'pages'          => $request->pages,
            'summary'        => $request->summary,
            'is_available'   => $request->is_available,
        ]);

        // Need to fire the websocket

        return $this->sendResponse($books, "books details created successfully", 201);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'author_id'      => 'required|integer',
            'title'          => 'required|string|max:255',
            'published_year' => 'required|integer',
            'language'       => 'required|string|max:50',
            'pages'          => 'required|integer',
            'summary'        => 'required|string|max:500',
            'is_available'   => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $books = Books::findOrFail($id);

        $books->update($request->all());

        // Need to call the websocket

        return $this->sendResponse($books, "book details updated successfully");
    }

    public function destroy(string $id)
    {
        $books = Books::find($id);

        if (! $books) {
            return $this->sendError('Book not found');
        }

        $books->delete();
        return $this->sendResponse('Success', 'Book deleted successfully');
    }
}

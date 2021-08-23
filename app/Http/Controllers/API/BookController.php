<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\BookStoreRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private CategoryService $categoryService;
    private BookService $bookService;
    private AuthorService $authorService;

    public function __construct(
        CategoryService $categoryService,
        BookService $bookService,
        AuthorService $authorService
    ) {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }
    /**
     * @OA\Get(
     *     path="/books",
     *     operationId="booksAll",
     *     tags={"Books"},
     *     summary="Display a listing of the resource",
     *     security={
     *       {"api_key": {}},
     *     },
     *      @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $books = $this->bookService->paginate();
        return response()->json($books);
    }

    /**
     * @OA\Post(
     *     path="/books",
     *     operationId="exampleCreate",
     *     tags={"Books"},
     *     summary="Create yet another example record",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookStoreRequest")
     *     ),
     * )
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookStoreRequest $bookData): JsonResponse
    {

        $model = new Book();
        $model->fill($bookData->all());
        $model->save();

        return response()->json($model);
    }

    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     operationId="examplesGet",
     *     tags={"Books"},
     *     summary="Get example by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $books = $this->bookService->getId($id);
        return response()->json($books);
    }

    /**
     * @OA\Put(
     *     path="/books/{id}",
     *     operationId="booksUpdate",
     *     tags={"Books"},
     *     summary="Update example by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                  title="image",
     *                  description="file to upload",
     *                  property="image",
     *                  type="string",
     *                  format="binary",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *   )
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BookStoreRequest $request, int $id): JsonResponse
    {
        $book = Book::query()->findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($book->image);
            $image_name = $request->file('image')->store('uploads', 'public');
            $book->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_name,
            ]);
        }

        $book->save();

        return response()->json($request->image);
    }

    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     operationId="booksDelete",
     *     tags={"Books"},
     *     summary="Delete example by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="202",
     *         description="Deleted",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(int $id): Response
    {
        $book = Book::find($id);
        $book->categories()->detach();
        $book->authors()->detach();
        $book->delete();

        return response(null, HttpResponse::HTTP_ACCEPTED);
    }


}

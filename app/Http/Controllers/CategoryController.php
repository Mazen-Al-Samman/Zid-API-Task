<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $userRepository)
    {
        $this->categoryRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => $this->categoryRepository->listAll()], ResponseAlias::HTTP_OK);
    }
}

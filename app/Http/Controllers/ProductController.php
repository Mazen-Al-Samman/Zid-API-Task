<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepository $repository)
    {
        $this->productRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): array
    {
        return $this->productRepository->listAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductPostRequest $request
     * @return JsonResponse
     */
    public function store(ProductPostRequest $request): JsonResponse
    {
        $model = $this->productRepository->create($request->all());
        if ($model) {
            return response()->json([
                'message' => 'Product successfully Created',
                'product' => $model
            ], ResponseCodes::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'Something wrong!',
            'store' => null
        ], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $model = ProductRepository::getById($id);
        if (empty($model)) return response()->json([
            'error' => "Product not found!"
        ], ResponseCodes::HTTP_NOT_FOUND);

        return response()->json([
            'data' => $model
        ], ResponseCodes::HTTP_OK);
    }
}

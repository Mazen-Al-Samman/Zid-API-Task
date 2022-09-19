<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Repositories\StoreRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class StoreController extends Controller
{
    private $storeRepository;

    public function __construct(StoreRepository $repository)
    {
        $this->storeRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'store' => auth()->user()->store()->with(['category'])->get()
        ], ResponseCodes::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $model = $this->storeRepository->create($request->all());
        if ($model) {
            return response()->json([
                'message' => 'Shop successfully Created',
                'store' => $model
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
     * @param $slug
     * @return JsonResponse
     */
    public function show($slug): JsonResponse
    {
        $storeModel = StoreRepository::getBySlug($slug);
        if (!empty($storeModel)) return response()->json(['store' => $storeModel], ResponseCodes::HTTP_OK);
        return response()->json(['error' => 'No Store with the given slug!'], ResponseCodes::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function update(StoreRequest $request): JsonResponse
    {
        $requestAttributes = $request->all();

        // No Need to check if empty, already checked via UserHasStore middleware.
        $requestAttributes['id'] = auth()->user()->store->id;
        $model = $this->storeRepository->update($requestAttributes);

        if ($model) {
            return response()->json([
                'message' => 'Shop successfully Updated',
                'store' => $model
            ], ResponseCodes::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'Something wrong!',
            'store' => null
        ], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
    }
}

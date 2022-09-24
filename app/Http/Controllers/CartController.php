<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartDetailsPostRequest;
use App\Repositories\CartDetailsRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class CartController extends Controller
{
    private $cartRepository;
    private $productRepository;
    private $cartDetailsRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository, CartDetailsRepository $cartDetailsRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->cartDetailsRepository = $cartDetailsRepository;

    }

    public function get(): JsonResponse
    {
        $model = $this->cartRepository->findByUserId(auth()->id());
        return response()->json([
            'message' => 'Cart Info',
            'cart' => $model,
            'items' => $this->productRepository->getByCart($model),
        ], ResponseCodes::HTTP_OK);
    }

    /**
     * @param CartDetailsPostRequest $request
     * @return JsonResponse
     */
    public function addToCart(CartDetailsPostRequest $request): JsonResponse
    {
        $cartModel = $this->cartRepository->findByUserId(auth()->id());
        $request['cart_id'] = $cartModel->id;
        $this->cartDetailsRepository->addToCart($request->all());
        return response()->json([
            'message' => 'Product Ordered successfully',
            'cart' => $cartModel,
            'items' => $this->productRepository->getByCart($cartModel),
        ], ResponseCodes::HTTP_OK);
    }
}

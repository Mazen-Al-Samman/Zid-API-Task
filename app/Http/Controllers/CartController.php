<?php

namespace App\Http\Controllers;

use App\Helpers\ProductSerializer;
use App\Http\Requests\CartDetailsPostRequest;
use App\Repositories\CartDetailsRepository;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;

class CartController extends Controller
{
    private $cartRepository;
    private $productRepository;
    private $cartDetailsRepository;
    private $orderRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository, CartDetailsRepository $cartDetailsRepository, OrderRepository $orderRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->cartDetailsRepository = $cartDetailsRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return JsonResponse
     */
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
        $products = $this->productRepository->getByCart($cartModel);
        return response()->json([
            'message' => 'Product Ordered successfully',
            'cart' => $cartModel,
            'items' => ProductSerializer::get($products),
        ], ResponseCodes::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function checkout(): JsonResponse
    {
        $cartModel = $this->cartRepository->getPendingCart(auth()->id());
        if (empty($cartModel)) {
            return response()->json([
                'message' => "You don't have any carts!"
            ], ResponseCodes::HTTP_BAD_REQUEST);
        }

        $products = $this->productRepository->getByCart($cartModel);
        $totalPrice = $this->productRepository->getCartTotalPrice($cartModel);

        return response()->json([
            'products' => ProductSerializer::get($products),
            'totalPrice' => $totalPrice
        ]);
    }

    public function confirmCheckout(): JsonResponse
    {
        $cartModel = $this->cartRepository->getPendingCart(auth()->id());
        if (empty($cartModel)) {
            return response()->json([
                'message' => "You don't have any carts!"
            ], ResponseCodes::HTTP_BAD_REQUEST);
        }

        $cartDone = $this->cartRepository->confirmCheckout($cartModel);
        if ($cartDone) {
            $this->orderRepository->create($cartModel->id, auth()->id());
            return response()->json([
                'message' => 'Order done, Thank you <3'
            ], ResponseCodes::HTTP_OK);
        }
        return response()->json([
            'error' => 'An error occurred!!'
        ], ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);
    }
}

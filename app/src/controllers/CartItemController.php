<?php

require_once(__DIR__ . '/../models/CartItemModel.php');

class CartItemController {
    private CartItemModel $cartItemModel;

    public function __construct() {
        $this->cartItemModel = new CartItemModel();
    }

    public function fetchPassCartItem(int $id): ?CartItemDTO {
        return $this->cartItemModel->fetchPassCartItem($id);
    }

    public function fetchDanceShowItem(int $id, string $slug): ?CartItemDTO {
        return $this->cartItemModel->fetchDanceShowItem($id, $slug);
    }

    public function fetchRestaurantCartItem(int $id): ?array {
        return $this->cartItemModel->fetchRestaurantCartItem($id);
    }

    public function fetchTourCartItem(): ?array {
        return $this->cartItemModel->fetchTourCartItem();
    }
}
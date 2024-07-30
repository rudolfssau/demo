<?php

namespace Main\App\Controllers;

use Main\App\Models\Domain\Repository\AttributeRepositoryInterface;
use Main\App\Models\Domain\Repository\ProductRepositoryInterface;

class Delete extends Controller
{
    /**
     * @param ProductRepositoryInterface $productRepository
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct (protected readonly ProductRepositoryInterface $productRepository, protected readonly AttributeRepositoryInterface $attributeRepository)
    {
    }

    /**
     * Responsible for the removal of select items from the MySQL database.
     * It gets the selected (checkbox checked) "id" values from the json file.
     * Finally, it deletes the specific record in the databased based on the selected item "id".
     *
     * @return void
     */
    public function __invoke(): void
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        foreach ($data["id"] as $key => $attributeId)
        {
            $this->attributeRepository->delete($attributeId);
            $this->productRepository->delete($attributeId);
        }
    }
}
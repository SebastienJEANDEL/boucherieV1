<?php

namespace Oshop\Controllers;

// use Oshop\Models\Category;
// use Oshop\Models\Product;
// use Oshop\Models\Brand;
// use Oshop\Models\Type;
use Oshop\Models\{Category, Product,Brand,Type};

class CatalogController extends CoreController
{
    // Méthode chargée de gérer la page catégorie
    public function category($urlParams)
    {
        $idCategory = $urlParams['id'];

        // Ici, il faudra bientôt faire appel à nos models pour aller chercher
        // les informations de la catégorie ainsi que tous les produits
        // de cette catégorie
        $category = new Category();
        $currentCategory = $category->find($idCategory);

        $product = new Product();
        $poductsListWithTypeName = $product->findProductsWithTypeNameByCategoryId($idCategory);

        $this->show('category', [
            'current_category' => $currentCategory,
            'products_list_with_type_name' => $poductsListWithTypeName
        ]);
    }

    // Méthode chargée de gérer la page type
    public function type($urlParams)
    {
        // Pour l'URL : /catalogue/type/20
        // $urlParams = ['id' => "20"]
        $idType = $urlParams['id'];

        $product = new Product();
        $productsList = $product->findProductsByTypeId($idType);

        $type = new Type();
        $currentType = $type->find($idType);

        $this->show('type', [
            'current_type' => $currentType,
            'products_list' => $productsList
        ]);
    }

    // Méthode chargée de gérer la page marque
    public function brand($urlParams)
    {
        // Pour l'URL : /catalogue/marque/42
        // $urlParams = ['id' => "42"]
        $idBrand = $urlParams['id'];

        $product = new Product();
        $productsListWithTypeName = $product->findProductsWithTypeNameByBrandId($idBrand);

        $brand = new Brand();
        $currentBrand = $brand->find($idBrand);

        $this->show('brand', [
            'current_brand' => $currentBrand,
            'products_list_with_type_name' => $productsListWithTypeName
        ]);
    }

    // Méthode chargée de gérer la page produit
    public function product($urlParams)
    {
        $idProduct = $urlParams['id'];

        $product = new Product();
        $currentProduct = $product->find($idProduct);

        // Pour récupérer le nom de la marque, on peut récupérer l'objet Brand
        // à partir de la propriété brand_id
        $brand = new Brand();
        $currentProductBrandId = $currentProduct->getBrandId();
        $currentProductBrand = $brand->find($currentProductBrandId);

        $category = new Category();
        $currentProductCategoryId = $currentProduct->getCategoryId();
        $currentProductCategory = $category->find($currentProductCategoryId);

        $this->show('product', [
            'current_product' => $currentProduct,
            'current_product_brand' => $currentProductBrand,
            'current_product_category' => $currentProductCategory
        ]);
    }
}
# Routes

## Sprint 1

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `home` | Dans les shoe | 5 categories | - |
| `/mentions-legales/` | `GET` | `MainController` | `legalMentions` | Mentions légales | Legal mentions content | - |
| `/catalogue/categorie/[id]` | `GET` | `CatalogController` | `category` | Category name | Category name and all products from this category | `id` stands for category id |
| `/catalogue/type/[id]` | `GET` | `CatalogController` | `type` | Type name | Type name and all products from this type | `id` stands for type id |
| `/catalogue/marque/[id]` | `GET` | `CatalogController` | `brand` | Brand name | Brand name and all products from this brand | `id` stands for brand id |
| `/catalogue/produit/[id]` | `GET` | `CatalogController` | `product` | Product name | Product name and all other product details (price, picture, rate, category, brand) | `id` stands for product id |
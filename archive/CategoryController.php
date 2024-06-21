<?php
namespace archive;

class CategoryController {
	public function show($shop) {
		$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT);
		if($cat_id) {
			$navigation = $shop->getCategories()->getNavigation();
			$category = $shop->getCategories()->getCategoryById($cat_id);
			$title = 'Category - ' . $category['name'];
			$products_by_cat = $shop->getProducts()->fetchProductsByCategory($cat_id);

			\Cm\Shop\Helper\Renderer::render(ROOT_PATH . '/public/views/category.view.php', [
				'title' => $title,
				'navigation' => $navigation,
				'products' => $products_by_cat,
				'count' => $count,
				'cat_id' => $category['id']
			]);
		}
	}
}
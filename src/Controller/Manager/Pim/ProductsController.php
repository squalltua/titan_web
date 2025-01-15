<?php

declare(strict_types=1);

namespace App\Controller\Manager\Pim;

use App\Controller\Manager\AppController;
use Cake\Http\Response;
use Cake\Utility\Text;
use Cake\I18n\Number;
use Cake\Utility\Hash;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{
    /**
     * Initialize method
     *
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'pim_menu');
        $this->set('subMenuActive', 'products');
        $this->set('applicationName', __('Product information management'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response
     */
    public function index()
    {
        $limit = (int) $this->request->getQuery('show_entries', 25);
        $conditions = $this->request->getQuery('keyword') ? ['title LIKE' => "%{$this->request->getQuery('keyword')}%"] : [];
        $products = $this->paginate($this->Products->getAllProducts($conditions), ['limit' => $limit]);

        $this->set(compact('products'));
    }

    /**
     * Product detail method
     *
     * @param string $id - Product id
     *
     * @return Response
     */
    public function detail(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $languages = $this->fetchTable('Languages')->getTabList();

        $product = $this->Products->getInformation($id, $selectLanguage);
        $product->base_price = Number::precision($product->base_price ?? 0.00, 2);
        $product->sell_price = Number::precision($product->sell_price ?? 0.00, 2);
        $product->discount_price = Number::precision($product->discount_price ?? 0.00, 2);

        $this->set('objectMenuActive', 'detail');
        $this->set(compact('product', 'selectLanguage', 'languages'));
    }

    /**
     * Meta index method
     *
     * @param string $id - Product Id
     *
     * @return Response
     */
    public function meta(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $product = $this->Products->getInformation($id, $selectLanguage);
        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set('objectMenuActive', 'meta');
        $this->set(compact('product', 'selectLanguage', 'languages'));
    }

    /**
     * Meta add method
     *
     * @param string $productId - product id
     *
     * @return Response
     */
    public function metaAdd(string $productId)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $product = $this->Products->getInformation($productId, $selectLanguage);
        $meta = $this->Products->MetaProducts->newEmptyEntity();
        if ($this->request->is('post')) {
            $meta = $this->Products->MetaProducts->patchEntity($meta, $this->request->getData());
            $meta->product_id = $productId;
            if ($this->Products->MetaProducts->save($meta)
                && $this->Products->MetaProducts->link($product, [$meta])
            ) {
                $this->Flash->success(__('The meta attribute has been saved.'));

                return $this->redirect("/manager/pim/products/meta/{$productId}");
            }

            $this->Flash->error(__('The meta attribute could not be saved. Please try again.'));
        }

        $this->set('objectMenuActive', 'meta');
        $this->set(compact('product', 'meta'));
    }

    /**
     * Meta edit method
     *
     * @param string $productId - product id
     * @param string $metaId    - meta id
     *
     * @return Response
     */
    public function metaEdit(string $productId, string $metaId)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $product = $this->Products->getInformation($productId, $selectLanguage);
        $meta = $this->Products->MetaProducts->get($metaId);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $meta = $this->Products->MetaProducts->patchEntity($meta, $this->request->getData());
            if ($this->Products->MetaProducts->save($meta)) {
                $this->Flash->success(__('The meta attribute has been saved.'));

                return $this->redirect("/manager/pim/products/meta/{$productId}");
            }

            $this->Flash->error(__('The meta attribute could not be saved. Please try again.'));
        }

        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set('objectMenuActive', 'meta');
        $this->set(compact('product', 'meta', 'selectLanguage', 'languages'));
    }

    /**
     * Meta delete method
     *
     * @param string $productId - product id
     * @param string $metaId    - meta id
     *
     * @return \Cake\Http\Response
     */
    public function metaDelete(string $productId, string $metaId)
    {
        $this->request->allowMethod(['delete', 'post']);
        $meta = $this->Products->MetaProducts->get($metaId);
        if ($this->Products->MetaProducts->delete($meta)) {
            $this->Flash->success(__('The meta attribute has been deleted.'));
        } else {
            $this->Flash->error(__('The meta attribute could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/pim/products/meta/{$productId}");
    }

    /**
     * Product add method
     *
     * @return Response|null
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->status = 'active';
            $product->slug = Text::slug($product->title);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/detail/{$product->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Products->Categories->getCategoriesList();

        $this->set(compact('product', 'categories'));
    }

    /**
     * Product edit method
     *
     * @param string $id - product id
     *
     * @return \Cake\Http\Response
     */
    public function edit(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();
        $product = $this->Products->getInformation($id, $selectLanguage);

        if ($this->request->is(['post', 'put', 'patch'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/edit/{$product->id}?lang={$selectLanguage}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $categories = $this->Products->Categories->getCategoriesList();
        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set(compact('product', 'categories', 'selectLanguage', 'languages'));
    }

    /**
     * Delete product method
     *
     * @param string $id - product id
     *
     * @return \Cake\Http\Response
     */
    public function delete(string $id): Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $product = $this->Products->get($id);
        $product->status = 'deleted';
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect('/manager/pim/products');
    }

    /**
     * Images method
     *
     * @param string $productId - product id
     *
     * @return \Cake\Http\Response
     */
    public function images(string $productId)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $product = $this->Products->getInformation($productId, $selectLanguage);
        if ($this->request->is('post')) {
            // upload feature image only
            if ($this->request->getData('feature_image')) {
                $featureImage = $this->request->getData('feature_image');
                if (!$featureImage->getError()) {
                    $featureMedia = $this->fetchTable('Medias')->uploadImage('feature_image', $featureImage);
                    if ($featureMedia && $this->fetchTable('Products')->Medias->link($product, [$featureMedia])) {
                        $this->Flash->success(__('The feature image has been uploaded.'));
                    } else {
                        $this->Flash->error(__('The product feature image could not link with prodcut data. Please try again.'));
                    }
                }
            }

            // upload other image
            if ($this->request->getData('product_image')) {
                $productImage = $this->request->getData('product_image');
                if (!$productImage->getError()) {
                    $productMedida = $this->fetchTable('Medias')->uploadImage('product_image', $productImage);
                    if ($productMedida && $this->fetchTable('Products')->Medias->link($product, [$productMedida])) {
                        $this->Flash->success(__('The product image has been uploaded.'));
                    } else {
                        $this->Flash->error(__('The product image could not link with product data. Please try again.'));
                    }
                }
            }

            return $this->redirect("/manager/pim/products/images/{$productId}");
        }

        $medias = [
            'featureMediaImage' => null,
            'productMediaImages' => [],
        ];
        foreach ($product->medias as $media) {
            if ($media->using_type === 'feature_image') {
                $medias['featureMediaImage'] = $media;
            } elseif ($media->using_type === 'product_image') {
                $medias['productMediaImages'][] = $media;
            }
        }

        $this->set('objectMenuActive', 'images');
        $this->set(compact('product', 'medias'));
    }

    /**
     * Remove image of product.
     *
     * @param string $productId - Product id
     * @param string $mediaId   - Media id
     *
     * @return Response|null
     */
    public function removeImage(string $productId, string $mediaId): ?Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $media = $this->fetchTable('Medias')->get($mediaId);
        if (unlink($media->path) && $this->fetchTable('Medias')->delete($media)) {
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/pim/products/images/{$productId}");
    }

    /**
     * Variants method
     *
     * @param string $id - Product id
     *
     * @return Response
     */
    public function variants(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $product = $this->Products->getInformation($id, $selectLanguage);
        foreach ($product->variants as &$variant) {
            $attributeOptions = Hash::extract($variant->attribute_options, '{n}.value');
            $variant->attribute_options_display = implode(', ', $attributeOptions);
        }

        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set('objectMenuActive', 'variants');
        $this->set(compact('product', 'selectLanguage', 'languages'));
    }

    /**
     * Variant add method
     *
     * @param string $id - Product id
     *
     * @return Response
     */
    public function variantAdd(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $product = $this->Products->getInformation($id, $selectLanguage);
        $variant = $this->fetchTable('Variants')->newEmptyEntity();
        if ($this->request->is('post')) {
            $variant = $this->fetchTable('Variants')->patchEntity($variant, $this->request->getData());
            $variant->product_id = $id;
            $variant->slug = Text::slug(strtolower($variant->title));
            if ($this->fetchTable('Variants')->save($variant)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/variant-edit/{$id}/{$variant->id}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $variantOptions = $this->fetchTable('Attributes')->find('list')->all()->toArray();
        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set('objectMenuActive', 'variants');
        $this->set(compact('product', 'variant', 'variantOptions', 'selectLanguage', 'languages'));
    }

    /**
     * Variant edit method
     *
     * @param string $id        - Product id
     * @param string $variantId - Variant id
     *
     * @return Response
     */
    public function variantEdit(string $id, string $variantId)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $product = $this->Products->getInformation($id, $selectLanguage);
        $variant = $this->fetchTable('Variants')->get($variantId, ['contain' => ['AttributeOptions']]);
        if ($this->request->is(['post', 'put', 'patch'])) {
            $variant = $this->fetchTable('Variants')->patchEntity($variant, $this->request->getData());
            $variant->slug = Text::slug($variant->title);

            if ($this->fetchTable('Variants')->save($variant)) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/variant-edit/{$id}/{$variantId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $this->set('objectMenuActive', 'variants');
        $this->set(compact('product', 'variant'));
    }

    /**
     * Variant option add method
     *
     * @param string $id        - Product id
     * @param string $variantId - Variant id
     *
     * @return Response
     */
    public function variantOptionAdd(string $id, string $variantId)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $product = $this->Products->getInformation($id, $selectLanguage);
        $variant = $this->fetchTable('Variants')->get($variantId);
        if ($this->request->is('post')) {
            $attributeOption = $this->fetchTable('AttributeOptions')->get($this->request->getData('attribute_option_id'));
            if ($this->fetchTable('Variants')->AttributeOptions->link($variant, [$attributeOption])) {
                $this->Flash->success(__('The data has been saved.'));

                return $this->redirect("/manager/pim/products/variant-edit/{$id}/{$variantId}");
            }

            $this->Flash->error(__('The data could not be saved. Please try again.'));
        }

        $variantOptions = $this->fetchTable('Attributes')->find('list')->all()->toArray();

        $this->set('objectMenuActive', 'variants');
        $this->set(compact('product', 'variant', 'variantOptions'));
    }

    /**
     * Variant option delete method
     *
     * @param string $id        - Product id
     * @param string $variantId - Variant id
     * @param string $optionId  - Option id
     *
     * @return Response
     */
    public function variantOptionDelete(string $id, string $variantId, string $optionId)
    {
        $this->request->allowMethod(['delete', 'post']);
        $variant = $this->fetchTable('Variants')->get($variantId);
        $attributeOption = $this->fetchTable('AttributeOptions')->get($optionId);
        if ($this->fetchTable('Variants')->AttributeOptions->unlink($variant, [$attributeOption])) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/pim/products/variant-edit/{$id}/{$variantId}");
    }

    /**
     * Variant delete method
     *
     * @param string $id        - Product id
     * @param string $variantId - Variant id
     *
     * @return Response
     */
    public function variantDelete(string $id, string $variantId)
    {
        $this->request->allowMethod(['delete', 'post']);
        $variant = $this->fetchTable('Variants')->get($variantId);
        if ($this->fetchTable('Variants')->delete($variant)) {
            $this->Flash->success(__('The data has been deleted.'));
        } else {
            $this->Flash->error(__('The data could not be deleted. Please try again.'));
        }

        return $this->redirect("/manager/pim/products/variants/{$id}");
    }
}

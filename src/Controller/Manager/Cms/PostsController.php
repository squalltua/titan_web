<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cms;

use App\Controller\Manager\AppController;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Http\Exception\NotFoundException;

/**
 * @property \App\Model\Table\PostsTable $Posts
 * @property AuthenticationComponent $Authentication
 */
class PostsController extends AppController
{
    protected array $paginate = [
        'limit' => 25,
        'order' => [
            'Posts.created' => 'desc',
        ],
    ];

    public function initialize(): void
    {
        parent::initialize();

        $this->set('subMenu', 'cms_menu');
        $this->set('subMenuActive', 'posts');
        $this->set('applicationName', __('Content management system'));
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        try {
            $posts = $this->paginate($this->Posts);
        } catch (NotFoundException $e) {
            // Do something here like redirecting to first or last page.
            // $e->getPrevious()->getAttributes('pagingParams') will give you required info.
        }

        $this->set(compact('posts'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function view(string $id): \Cake\Http\Response
    {
        $post = $this->Posts->get($id, ['contain' => ['MetaPosts']]);
        $this->set(compact('post'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $post = $this->Posts->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $meta = $data['meta_posts'];

            // create attrachment data
            $featureImageData = $this->request->getUploadedFile('feature_image');
            $ogTagImageData = $this->request->getUploadedFile('meta_posts.og_tag_image');

            unset($data['meta_posts']);

            debug($featureImageData);
            debug($ogTagImageData);

            exit;


            $post = $this->Posts->patchEntity($post, $this->request->getData());
            $post->user_id = $this->Authentication->getIdentity()->getIdentifier();
            if ($this->Posts->save($post)) {
                // save media and upload feature image
                if (
                    $this->fetchTable('Medias')->uploadImage($featureImageData) &&
                    $this->fetchTable('Medias')->uploadImage($ogTagImageData)
                ) {

                }


                // save meta data
                if ($this->fetchTable('MetaPosts')->saveMetaData($meta)) {
                    $this->Flash->success(__('The post has been saved.'));

                    return $this->redirect("/manager/cms/posts/edit/{$post->id}");
                }

                $this->Flash->error(__('The meta data could not be saved.'));
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $categories = $this->fetchTable('PostGroups')->getCategoriesList();
        $tags = $this->fetchTable('PostGroups')->getTagsList();

        $this->set(compact('post', 'categories', 'tags'));
        $this->set('menuActive', 'new-post');

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $post = $this->Posts->get($id);
        if ($this->request->is(['post', 'put'])) {
            debug($this->request->getData());
            exit;
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect("/manager/cms/post/edit/{$post->id}");
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $categories = $this->fetchTable('PostGroups')->getCategoriesList();
        $tags = $this->fetchTable('PostGroups')->getTagsList();

        $this->set(compact('post', 'categories', 'tags'));

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function delete(string $id): \Cake\Http\Response
    {
        $this->request->allowMethod(['delete', 'post']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect("/manager/cms/posts");
    }

    public function publishedPosts()
    {
        /** ----------------------------------------
         * published post to json file or radis database.
         * ----------------------------------------- */

        return $this->redirect('/manager/cms/posts');
    }
}

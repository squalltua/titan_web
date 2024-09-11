<?php

declare(strict_types=1);

namespace App\Controller\Manager\Cms;

use App\Controller\Manager\AppController;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Hash;
use Parsedown;

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
        $Parsedown = new Parsedown();
        $post->content_display = $Parsedown->text($post->content);
        $categories = $this->fetchTable('PostGroups')->getCategoriesList();
        $tags = $this->fetchTable('PostGroups')->getTagsList();

        $this->set(compact('post', 'categories', 'tags'));

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
            unset($data['meta_posts']);

            // upload feature image and save to media data
            $featureImageData = $this->request->getUploadedFile('meta_posts.feature_image');
            $featureImageMedia = $this->fetchTable('Medias')->uploadImage($featureImageData);
            if (!$featureImageData) {
                $this->Flash->error(__('The feature image could not be uploaded. Please try again.'));
                return $this->redirect("/manager/cms/posts/add");
            }

            // upload og tag image and save to media data
            $ogTagImageData = $this->request->getUploadedFile('meta_posts.og_tag_image');
            $ogTagImageMedia = $this->fetchTable('Meaids')->uploadImage($ogTagImageData);
            if (!$ogTagImageData) {
                $this->Flash->error(__('The og tag image could not be uploaded. Please try again.'));
                return $this->redirect("/manager/cms/posts/add");
            }

            $post = $this->Posts->patchEntity($post, $this->request->getData());
            $post->user_id = $this->Authentication->getIdentity()->getIdentifier();
            if ($this->Posts->save($post)) {
                // save meta data
                if ($this->fetchTable('MetaPosts')->saveMetaData($meta, $post->id)) {
                    $this->Flash->success(__('The post has been saved.'));

                    return $this->redirect("/manager/cms/posts/view/{$post->id}");
                }

                $this->Flash->error(__('The meta data could not be saved.'));
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $postGroups = $this->fetchTable('PostGroups')->find('list');

        $this->set(compact('post', 'postGroups'));
        $this->set('menuActive', 'new-post');

        return $this->render();
    }

    /**
     * @param string $id
     * @return \Cake\Http\Response
     */
    public function edit(string $id): \Cake\Http\Response
    {
        $post = $this->Posts->get($id, ['contain' => ['MetaPosts', 'PostGroups']]);
        $post->meta = Hash::combine($post->meta_posts, '{n}.meta_key', '{n}.meta_value');
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $meta = $data['meta_posts'];
            unset($data['meta_posts']);
            $post = $this->Posts->patchEntity($post, $data);
            $metaPosts = $this->fetchTable('MetaPosts')->find()->where(['post_id' => $post->id]);
            if ($metaPosts->count()) {
                // update data
                foreach ($metaPosts as $metaPost) {
                    if (!in_array($metaPost->meta_key, $this->Posts->imageKey) && $meta[$metaPost->meta_key]) {
                        $metaPost->meta_value = $meta[$metaPost->meta_key];
                    } else {
                        foreach ($this->Posts->imageKey as $key) {
                            if ($metaPost->meta_key === $key && isset($meta[$key]) && !$meta[$key]->getError()) {
                                $mediaPath = null;
                                $imageMedia = $this->fetchTable('Medias')->uploadImage($key, $meta[$key]);
                                if ($imageMedia) {
                                    $mediaPath = $imageMedia->link_url;
                                } else {
                                    $this->Flash->error(__('The {0} image could not be uploaded. Please try again.', $key));

                                    return $this->redirect("/manager/cms/posts/edit/{$id}");
                                }

                                if (array_search($key, array_column($metaPosts->toArray(), 'meta_key'))) {
                                    // update
                                    if ($metaPost->meta_key === $key) {
                                        $metaPost->meta_value = $mediaPath;
                                    }
                                } else {
                                    // new
                                    $newMeta = $this->Posts->MetaPosts->newEntity([
                                        'post_id' => $id,
                                        'meta_key' => $key,
                                        'meta_value' => $mediaPath,
                                    ]);
                                    if (!$this->Posts->MetaPosts->save($newMeta)) {
                                        $this->Flash->error(__('The {0} meta could not be saved. Please try again.', $key));

                                        return $this->redirect("/manager/cms/posts/edit/{$id}");
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                // create all new data.
                $metaPostsData = [];
                foreach ($meta as $key => $value) {
                    if ($key === 'feature_image') {
                        $featureImageMediaId = '';
                        if (!$value->getError()) {
                            $featureImageMedia = $this->fetchTable('Medias')->uploadImage($value);
                            if ($featureImageMedia) {
                                $featureImageMediaId = $featureImageMedia->id;
                            } else {
                                $this->Flash->error(__('The feature image could not be uploaded. Please try again.'));

                                return $this->redirect("/manager/cms/posts/edit/{$id}");
                            }
                        }

                        $metaPostsData[] = [
                            'post_id' => $post->id,
                            'meta_key' => 'feature_image',
                            'meta_vakue' => $featureImageMedia->id,
                        ];
                    } elseif ($key === 'og_tag_image') {
                        $ogTagImageMediaId = '';
                        if (!$value->getError()) {
                            $ogTagImageMedia = $this->fetchTable('Meaids')->uploadImage($value);
                            if ($ogTagImageMedia) {
                                $ogTagImageMediaId = $ogTagImageMedia->id;
                            } else {
                                $this->Flash->error(__('The og tag image could not be uploaded. Please try again.'));

                                return $this->redirect("/manager/cms/posts/edit/{$id}");
                            }
                        }

                        $metaPostsData[] = [
                            'post_id' => $post->id,
                            'meta_key' => 'og_tag_image',
                            'meta_vakue' => $ogTagImageMedia->id,
                        ];
                    } else {
                        $metaPostsData[] = [
                            'post_id' => $post->id,
                            'meta_key' => $key,
                            'meta_value' => $value,
                        ];
                    }
                }

                $metaPosts = $this->fetchTable('MetaPosts')->newEntities($metaPostsData);
            }

            if (!$this->fetchTable('MetaPosts')->saveMany($metaPosts)) {
                $this->Flash->error(__('The meta data could not be saved.'));
            }

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect("/manager/cms/posts/edit/{$post->id}");
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $postGroups = $this->fetchTable('PostGroups')->find('list');

        $this->set(compact('post', 'postGroups'));

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

    public function removeImage(string $id, string $key)
    {
        $meta = $this->Posts->MetaPosts->find()->where(['post_id' => $id, 'meta_key' => $key])->first();
        $meta->meta_value = null;
        if ($this->Posts->MetaPosts->save($meta)) {
            $this->Flash->success(__('The image has been removed.'));
        } else {
            $this->Flash->error(__('The image could not be removed. Please try again'));
        }

        return $this->redirect("/manager/cms/posts/edit/{$id}");
    }

    public function publishedPosts()
    {
        /** ----------------------------------------
         * published post to json file or radis database.
         * ----------------------------------------- */

        return $this->redirect('/manager/cms/posts');
    }
}

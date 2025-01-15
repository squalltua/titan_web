<?php

declare(strict_types=1);

namespace App\Controller\Manager\Wcm;

use App\Controller\Manager\AppController;
use Authentication\Controller\Component\AuthenticationComponent;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\I18n\I18n;
use Cake\Utility\Hash;
use Cake\Utility\Text;
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

        $this->set('subMenu', 'wcm_menu');
        $this->set('subMenuActive', 'posts');
        $this->set('applicationName', __('Web content management'));
    }

    /**
     * @return Response|null
     */
    public function index()
    {
        $limit = (int) $this->request->getQuery('show_entries', 25);
        $conditions = $this->request->getQuery('keywork') ? ['title LIKE' => "%{$this->request->getQuery('keyword')}%"] : [];
        $posts = $this->paginate($this->Posts->getAllPosts($conditions), ['limit' => $limit]);
        $this->set(compact('posts'));
    }

    /**
     * @param string $id
     * @return Response|null
     */
    public function view(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $post = $this->Posts->getPostData($id, $selectLanguage);
        $Parsedown = new Parsedown();
        $post->content_display = $Parsedown->text($post->content);
        $post->meta = Hash::combine($post->meta_posts, '{n}.meta_key', '{n}.meta_value');
        $post->groups_display = implode(', ', Hash::extract($post->groups, '{n}.name'));
        $languages = $this->fetchTable('Languages')->getTabList();

        $this->set(compact('post', 'selectLanguage', 'languages'));
        $this->set('objectMenuActive', 'detail');
    }

    /**
     * @return Response|null
     * @throws \Exception
     */
    public function add()
    {
        $post = $this->Posts->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $meta = $data['meta_posts'];
            unset($data['meta_posts']);

            $post = $this->Posts->patchEntity($post, $data);
            $post->adminuser_id = $this->Authentication->getIdentity()->getIdentifier();
            $post->slug = Text::slug(strtolower($post->title));
            if ($this->Posts->save($post)) {
                // save meta data
                $metaPostsData = [];
                foreach ($meta as $key => $value) {
                    if (!in_array($key, $this->Posts->imageKey)) {
                        $metaPostsData[] = [
                            'post_id' => $post->id,
                            'meta_key' => $key,
                            'meta_value' => $value,
                        ];
                    }
                }

                foreach ($this->Posts->imageKey as $key) {
                    if (!$meta[$key]->getError()) {
                        $imageMedia = $this->fetchTable('Medias')->uploadImage($key, $meta[$key]);
                        if (!$imageMedia) {
                            $this->Flash->error(__('The {0} image could not be uploaded. Please try again.'));

                            return $this->redirect("/manager/wcm/posts/add");
                        }

                        $metaPostsData[] = [
                            'post_id' => $post->id,
                            'meta_key' => $key,
                            'meta_value' => $imageMedia->link_url,
                        ];
                    }
                }

                $metaPosts = $this->fetchTable('MetaPosts')->newEntities($metaPostsData);
                if (!$this->Posts->MetaPosts->saveMany($metaPosts)) {
                    $this->Flash->error(__('The meta data could not be saved.'));
                }

                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect("/manager/wcm/posts/view/{$post->id}");
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $groups = $this->fetchTable('Groups')->find('list');

        $this->set(compact('post', 'groups'));
        $this->set('menuActive', 'new-post');
    }

    /**
     * @param string $id
     * @return Response|null
     * @throws \Exception
     */
    public function edit(string $id)
    {
        $selectLanguage = $this->request->getQuery('lang') ?: $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $post = $this->Posts->getPostData($id, $selectLanguage);
        $post->meta = Hash::combine($post->meta_posts, '{n}.meta_key', '{n}.meta_value');
        if ($this->request->is(['post', 'put', 'patch'])) {
            // I18n::setLocale($selectLanguage);
            $data = $this->request->getData();
            $meta = $data['meta_posts'];
            unset($data['meta_posts']);
            $post = $this->Posts->patchEntity($post, $data);
            $post->slug = Text::slug(strtolower($post->title));

            foreach ($meta as $key => $value) {
                if (in_array($key, $this->Posts->imageKey) &&
                    array_search($key, array_column($post->meta_posts, 'meta_key'))) {
                    // update image
                    if (!$value->getError()) {
                        $imageMedia = $this->fetchTable('Medias')->uploadImage($key, $value);
                        if (!$imageMedia) {
                            $this->Flash->error(__('The {0} image could not be uploaded. Please try again.', $key));

                            return $this->redirect("/manager/wcm/posts/edit/{$id}?lang={$selectLanguage}");
                        }

                        $metaPostIndex = array_search($key, array_column($post->meta_posts, 'meta_key'));

                        $post->meta_posts[$metaPostIndex]->meta_value = $imageMedia->link_url;
                    }
                } elseif (in_array($key, $this->Posts->imageKey) &&
                    !array_search($key, array_column($post->meta_posts, 'meta_key'))) {
                    // new image
                    if (!$value->getError()) {
                        $imageMedia = $this->fetchTable('Medias')->uploadImage($key, $value);
                        if (!$imageMedia) {
                            $this->Flash->error(__('The {0} image could not be uploaded. Please try again.', $key));

                            return $this->redirect("/manager/wcm/posts/edit/{$id}?lang={$selectLanguage}");
                        }

                        $newMeta = $this->Posts->MetaPosts->newEntity([
                            'post_id' => $id,
                            'meta_key' => $key,
                            'meta_value' => $imageMedia->link_url,
                        ]);
                        if (!$this->Posts->MetaPosts->save($newMeta)) {
                            $this->Flash->error(__('The {0} meta could not be saved. Please try again.', $key));

                            return $this->redirect("/manager/wcm/posts/edit/{$id}?lang={$selectLanguage}");
                        }
                    }
                } else {
                    // update meta
                    $metaPostIndex = array_search($key, array_column($post->meta_posts, 'meta_key'));
                    $post->meta_posts[$metaPostIndex]->meta_value = $value;
                }
            }

            $this->Posts->MetaPosts->setLocale($selectLanguage);
            if ($this->Posts->save($post) && $this->Posts->MetaPosts->saveMany($post->meta_posts)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect("/manager/wcm/posts/edit/{$post->id}?lang={$selectLanguage}");
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $groups = $this->fetchTable('Groups')->find('list');
        $languages = $this->fetchTable('Languages')->getTabList();
        $defaultLanguage = $this->fetchTable('Languages')->getDefaultLanguageUnicode();

        $this->set(compact('post', 'groups', 'languages', 'selectLanguage', 'defaultLanguage'));
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

        return $this->redirect("/manager/wcm/posts");
    }

    /**
     * @param string $id - Post id
     * @param string $key
     * @return \Cake\Http\Response
     */
    public function removeImage(string $id, string $key, string $locale): \Cake\Http\Response
    {
        $meta = $this->Posts->MetaPosts->find()->where(['post_id' => $id, 'meta_key' => $key])->first();
        $meta->meta_value = null;
        $this->Posts->MetaPosts->setLocale($locale);
        if ($this->Posts->MetaPosts->save($meta)) {
            $this->Flash->success(__('The image has been removed.'));
        } else {
            $this->Flash->error(__('The image could not be removed. Please try again'));
        }

        return $this->redirect("/manager/wcm/posts/edit/{$id}?lang={$locale}");
    }
}
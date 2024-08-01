<?php

namespace App\Controller\Manager;

use App\Controller\Manager\AppController;

/**
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->set('menuActive', 'posts');
    }

    /**
     * @return \Cake\Http\Response
     */
    public function index(): \Cake\Http\Response
    {
        $posts = $this->paginate($this->Posts);
        $this->set(compact('posts'));

        return $this->render();
    }

    /**
     * @return \Cake\Http\Response
     */
    public function add(): \Cake\Http\Response
    {
        $post = $this->Posts->newEmptyEntity();

        if ($this->request->is('post')) {
            debug($this->request->getData());
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect("/manager/post/categories");
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $this->set(compact('post'));
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
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect("/manager/post/categories/edit/{$post->id}");
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $this->set(compact('post'));
        return $this->render();
    }

    public function delete(string $id): \Cake\Http\Response
    {
        return $this->render();
    }
}
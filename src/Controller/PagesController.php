<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\Utility\Hash;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function beforeRender(\Cake\Event\EventInterface $event)
    {
        $this->viewBuilder()->setTheme('DefaultTheme');
        $siteSettingData = $this->fetchTable('SiteSettings')->find('all');
        $siteSetting = Hash::combine($siteSettingData->toArray(), '{n}.key_field', '{n}.value_field');

        $this->set(compact('siteSetting'));
    }

    public function home(): Response
    {
        // load content here.

        return $this->render();
    }

    public function about(): Response
    {
        return $this->render();
    }

    public function contact(): Response
    {
        return $this->render();
    }

    public function blogs(): Response
    {
        $blogs = $this->fetchTable('Posts')->find()
            ->where([
                'status' => 'published',
            ])
            ->contain(['PostsPostGroups', 'MetaPosts'])
            ->orderByDesc('published');
        $this->set(compact('blogs'));

        return $this->render();
    }

    public function blog(string $slug): Response
    {
        $post = $this->fetchTable('Posts')->getPost($slug);
        $this->set(compact('post'));

        return $this->render();
    }

    /**
     * Sandbox Error 404 here
     * @return Response
     */
    public function pageNotFoundError(): Response
    {
        $this->viewBuilder()->setLayout('error');
        return $this->render();
    }
}

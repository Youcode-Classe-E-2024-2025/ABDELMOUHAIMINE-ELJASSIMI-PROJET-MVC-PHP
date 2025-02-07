<?php

namespace App\controllers\back;
use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use App\models\Article;

class DashboardController extends Controller{


    public function __construct() {
        parent::__construct('back');
    }
    public function Dashboard(): void
    {
        $session = new Session();
        $article = new Article();
        $articles = $article->fetch();
        $user = new User();
        $users = $user->fetchAll();

        $articleCount = count($articles);
        $userCount = count($users);

        $this->view('dashboard', [
            'articles' => $articles,
            'users' => $users,
            'articleCount' => $articleCount,
            'userCount' => $userCount
        ]);

    }

}
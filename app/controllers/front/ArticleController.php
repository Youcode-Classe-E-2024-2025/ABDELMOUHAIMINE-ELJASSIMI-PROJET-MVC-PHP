<?php

namespace App\Controllers\front;

use App\Core\Controller;
use App\models\Article;
use App\Core\Auth;

session_start();

class ArticleController extends Controller {

        public function CreateArticle(){

                $title = $_POST['title']; 
                $content = $_POST['content'];
                $article = new Article();
                $article->title = $title;
                $article->content = $content;
                $article->Author_id = $_SESSION["user_id"];
                $article->save();

                header('location: \home');

        }

        public function FetchArticle(){
            $article = new Article();
            $articles = $article->fetch();
            $this->view('home', ['articles' => $articles]);
        }

}

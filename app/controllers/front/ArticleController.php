<?php

namespace App\Controllers\front;

use App\Core\Controller;
use App\Models\Article;
use App\Core\Auth;

class ArticleController extends Controller {

public function CreateArticle(){

        if (isset($_POST['submit'])) {
        $title = $_POST['title']; 
        $description = $_POST['description'];
         $article = new Article();
         $article->title = $title;
         $article->description = $description;
         $article->save();

        }
}

}

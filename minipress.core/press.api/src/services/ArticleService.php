<?php

namespace press\api\services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use press\api\models\Article;

class ArticleService
{
    public function getPublishedArticles() : array
    {
        try {
            return Article::where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("Aucun article n'est publié");
        }
    }

    public function getArticlesPublishedByCategorieId(int $cat_id) : array
    {
        try {
            return Article::where('cat_id', $cat_id)->where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de la catégorie n'est pas renseigné");
        }
    }

    public function getArticlePublishedById(int $id_a) : array
    {
        try {
            return Article::where('id', $id_a)->where('date_publication', '<=', date_create()->format('Y-m-d H:i:s'))->firstOrFail()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'article n'est pas renseigné");
        }
    }

    
    function getIdAuteur(){
        $users = User::all();
        return $users;
    }

    function getArticlesByIdAuteur(int $id_auteur): array
    {
        try {
            return Article::where('id_auteur', $id_auteur)->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new Exception("L'id de l'auteur n'est pas renseigné");
        }
    }


}
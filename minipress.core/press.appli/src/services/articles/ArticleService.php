<?php

namespace press\app\services;

use Erusev\Parsedown\Parsedown;
use Exception;
use Michelf\Markdown;
use press\app\models\Article;
use press\app\models\Categorie;
use Slim\Exception\HttpBadRequestException;

class ArticleService{

    /**
     * Méthode permettant de récupérer tous les articles
     * @return array $articles
     */
    function getArticles(): array
    {
        $articles = Article::all();

        $parser = new \cebe\markdown\Markdown();
        $parser->html5 = true;
        $parser->keepListStartNumber = true;
        foreach ($articles as $art)
        {
            // chaque resume et contenu d'un article est converti en html
            $art['resume'] = $parser->parse($art['resume']);
            $art['contenu'] = $parser->parse($art['contenu']);
        }

        return $articles->toArray();
    }

    /**
     * Méthode permettant de récupérer un article par son id
     * @param int $id
     * @return array $article
     * @throws Exception $e
     */
    function getArticleById(int $id) : array {
        try {
            return Article::findOrFail($id)->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * Méthode permettant de créer un article
     * @param array $data
     * @return array $article
     */
    function createArticle(array $data): array
    {
        //pens

        $article = new Article();
        $article->titre = $data['titre'];
        $article->date_creation = date_create()->format('Y-m-d H:i:s');
        $article->auteur = $data['auteur'];

        $article->resume = htmlspecialchars_decode(str_replace("&#13;&#10;", "", $data['resume']));
        $article->contenu = htmlspecialchars_decode(str_replace("&#13;&#10;", "", $data['contenu']));

        $article->date_publication = date_create()->format('Y-m-d H:i:s');

        if ($data['image'] === '') {
            $data['image'] = null;
        }
        $article->image = $data['image'];

        $article->idCateg = $data['cats'];
        $article->save();
        return $article->toArray();
    }

    /**
     * Méthode permettant de supprimer un article
     * @param int $idArt
     * @return array $article
     */
    function deleteArticle(int $idArt): array
    {
        try {
            $article = Article::findOrFail($idArt);
            $article->delete();
            return $article->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }
    /**
     * Méthode permettant de mettre à jour un article
     * @param int $idArt
     * @param array $data
     * @return array $article
     */
    function updateArticle(int $idArt, array $data) : array {
        try {
            $article = Article::findOrFail($idArt);
            $article->titre = $data['titre'];
            $article->contenu = $data['contenu'];
            $article->idCateg = $data['idCateg'];
            $article->save();
            return $article->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de l'article n'est pas renseigné");
        }
    }

    /**
     * méthode permettant de récupérer les articles d'une catégorie
     * @param int $idCat id de la catégorie
     * @return array $articles
     * @throws Exception $e
     */
    function getArticlesByCategorie(int $idCat) : array {
        try {
            $articles = Article::where('idCateg', $idCat)->get();
            return $articles->toArray();
        }catch(\Exception $e) {
            throw new \Exception( "L'id de la catégorie n'est pas renseigné");
        }
    }

    public function getArticlesByCategorieId( $id) : array {
        try {
            return Article::where('idCateg', $id)->get()->toArray();
        }catch(ModelNotFoundException $e) {
            throw new HttpBadRequestException($request, "L'id de la catégorie n'est pas renseigné");
        }
    }


}
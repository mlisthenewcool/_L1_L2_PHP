<?php

class Caddie
{
    private $articles;
    private $quantites;
    private static $_instance;

    private function __construct() {
        $this->articles = array();
        $this->quantites = array();
    }
    public static function getInstance() {
        if (is_null(self::$_instance))
            self::$_instance = new Caddie();
        return self::$_instance;
    }


    public function ajouter(Article $article, $quantite) {
        $id = $article->getReference();

        if (isset($this->articles[$id])) {
            $this->articles[$id] = $article;
            $this->quantites[$id] = $this->quantites[$id] + (int) $quantite;
        }
        else {
            $this->articles[$id] = $article;
            $this->quantites[$id] = (int) $quantite;
        }
    }

    public function afficher () {
        foreach ($this->articles as $article) {
            $quantite = $this->quantites[$article->getReference()];
            $prix = $article->getPrix();
            echo (
                '<tr>' .
                '<td class="text-center">' . $quantite . '</td>' .
                '<td class="text-center">' . $article->getReference() . '</td>' .
                '<td class="text-center">' . $article->getDesignation() . '</td>' .
                '<td class="text-center">' . $article->getPrix() . '</td>' .
                '<td class="text-center">' . $quantite * $prix . '</td>' .
                '<tr>'
            );
        }
    }

    public function total() {
        $total = 0;
        foreach ($this->articles as $article) {
            $id = $article->getReference();
            $prixUnit = $article->getPrix();
            $total = $total + $prixUnit * $this->quantites[$id];
        }
        return $total;
    }

    public function getNbArticles() {
        return count($this->articles);
    }

    public function getArticles() {
        return $this->articles;
    }

    public function getQuantites() {
        return $this->quantites;
    }
}
<?php

class NewsController extends Controller
{
    public function init()
    {

    }

    public function index()
    {
        $newsModel = new News();
        $news = $newsModel->getAll();
        $this->data['news'] = $news;
    }
}

?>
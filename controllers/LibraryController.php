<?php
/**
 * Created by PhpStorm.
 * User: Viktor
 * Date: 03.12.2017
 * Time: 11:58
 */




class LibraryController extends Controller
{
    function index(){
        if(!empty ($_POST)){

            if(isset($_POST['book_author_search'])){

                Router::redirect("/library/book_author_search/".$_POST['book_author_search']);
            }


        }

    }
    function book_author_search(){

        $this->params;
        $this->data['params'] = $this->params;
        $books_table = new Books();
        $this->data['books'] = $books_table->search_by_author($this->params[0]);

    }

}
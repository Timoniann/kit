<?php

class LibraryController extends Controller
{
    function index(){
        if(!empty ($_POST)){

            if(isset($_POST['book_author_search']))
                Router::redirect("/library/book_author_search/" . $_POST['book_author_search']);

            elseif(isset($_POST['book_name_search']))
                Router::redirect("/library/book_name_search/" . $_POST['book_name_search']);
        }
    }

    function book_name_search(){

        $this->params;
        $this->data['params'] = $this->params;
        $books_table_name = new Books();
        $this->data['books'] = $books_table_name->search_by_name(array_pop($this->params));

    }

    function book_author_search(){

        $this->params;
        $this->data['params'] = $this->params;
        $books_table_author = new Books();
        $this->data['books'] = $books_table_author->search_by_author(array_pop($this->params));

    }


}
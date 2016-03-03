<?php

namespace App\View\Helper;

use Cake\View\Helper;

class TreeHelper extends Helper {

    public function montarArvore($array) {
        if (count($array)) {
            echo "\n<ul>\n";
            foreach ($array as $vals) {
                $id = $vals['id'];
                $nome = $vals['nome'];
                echo "<li id=\"" . $id . "\">" . $vals['nome'];
                echo "&nbsp;<a href='/categorias/add?slc_cat=$id' title='Inserir uma categoria filho nesta categoria'><i class='fa fa-plus'></i></a>";
                echo "&nbsp;<a href='/categorias/edit/$id' title='Alterar esta categoria'><i class='fa fa-edit'></i></a>";
                echo "&nbsp;<a href='javascript:void(0);' onclick='if(confirm(\"Confirma a exclusão da categoria ($nome) ?\")) { window.location.href = \"/categorias/delete/$id\" } else {return false;}'title='Excluir esta categoria'><i class='fa fa-remove'></i></a>";
                if (count($vals['children'])) {
                    $this->montarArvore($vals['children']);
                }
                echo "</li>\n";
            }
            echo "</ul>\n";
        }
    }

}

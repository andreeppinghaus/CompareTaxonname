<?php
declare(strict_types=1);

namespace CompareTaxonName;

/** 
 * Comparacao de nomes de espécies da flora com sub especie e variadade
 * @author André Eppinghaus
 * 
*/
    
class CompareTaxonName {
  public function __construct() {
  }

  /**
   * Comparacao de nomes taxonomicos
   * 
   * @param string $scientificNameSource Nome cientifico vindo do banco de dados
   * @param string $scientificNameSearch Nome cientifico procurado
   * @return boolean
   */
  
  function compare($scientificNameSource, $scientificNameSearch) {
     $foundSppSource = false;
     $foundNameSppSource = false;
     $foundSppSearch = false;
     $foundNameSppSearch = false;
     $foundVarSource = false;
     $foundNameVarSource = false;
     $foundVarSearch = false;
     $foundNameVarSearch = false;
     $spp='';

     $explodeNameSource = explode(' ', $scientificNameSource);
     $explodeNameSearch = explode(' ', $scientificNameSearch);

     //montando as posicoes de nome da especie procurada
     
     //busca por spp.
     $foundSppSearch = array_search("subsp.", $explodeNameSearch);
     if ($foundSppSearch === false) {
        //senao encontrou, busca por subsp.
//        echo "<pre>subsp. nao existe = $scientificNameSearch </pre>";
        $foundSppSearch = array_search("spp.",$explodeNameSearch);
 //       echo "<pre>posicao $foundSppSearch</pre>";
     }
     
     //verifica se tem variedade em qualquer posicao
     $foundVarSearch =  array_search("var.", $explodeNameSearch);
  
     //montando as posicoes de nome da especie original
     
     //busca por spp.
     $foundSppSource = array_search("subsp.", $explodeNameSource);
     if ($foundSppSource === false) {
  //      echo "<pre>subsp. nao existe = $scientificNameSource </pre>";
        //senao encontrou, busca por subsp.
        $foundSppSource = array_search("spp.",$explodeNameSource);
     }
     
     //verifica se tem variedade em qualquer posicao
     $foundVarSource =  array_search("var.", $explodeNameSource);

     //genero e epiteto sao iguais ?       
     
      $found = false;
      //verifica genero e epiteto
     if ($explodeNameSource[0]==$explodeNameSearch[0] && $explodeNameSource[1]==$explodeNameSearch[1] ) {
         $found=true;
  
       //existe subspecie ?
       // erro aqui tem que retornar falso se uma das duas cndicoes foram verdadeiras
        if ($foundSppSearch !== false && $foundSppSource !== false) {

        //verifica se subspecie esta na mesma posicao
           if ($foundSppSource == $foundSppSearch ) {
              //verifica se tem mesmo nome
      /*        echo "<pre><br>";
              echo "$scientificNameSource = $scientificNameSearch <br>";
              echo "conta source array=";
              echo count($explodeNameSource);
              echo "<br>posicao=$foundSppSource";
              echo "<br>conta search array=";
              echo count($explodeNameSearch);
              echo "<br>posicao=$foundSppSearch";
              //echo $explodeNameSource[$foundSppSource]."=".$explodeNameSearch[$foundSppSearch];
              echo "<br></pre>";
*/
              if ($explodeNameSource[$foundSppSource+1]==$explodeNameSearch[$foundSppSearch+1]) {
                 $found=true;
              }else {
                 $found=false; //nao tem o mesmo nome
              }
           }else {
              $found=false; //nao esta na mesma posicao
           } 
        }else if ($foundSppSearch === false || $foundSppSource === false) {
            $found=false;
        }//fim verifica subespecie

         //existe variedade ?
        if ($foundVarSearch !== false && $foundVarSource) {
        //verifica se variedade esta na mesma posicao
           if ($foundVarSource == $foundVarSearch ) {
              //verifica se tem mesmo nome
              if ($explodeNameSource[$foundSppSource+1]==$explodeNameSearch[$foundSppSearch+1]) {
                 $found=true;
              }else {
                 $found=false; //nao existe o mesmo nome
             }
           }else {
              $found=false;//nao esta na mesma posicao   
           } 
        }else if ($foundVarSearch === false || $foundVarSource === false) {
            $found=false;
        }//fim verifica variedade
     }//fim verifica generoe epiteto
     
    //if (strpos($scientificNameSource,"subsp. album") ) {

    if ($found) {
     echo "<pre>iguais---------<br>";
    }else {
     echo "<pre>diferentes---------<br>";
    }
     echo " source: $scientificNameSource <br>";
     echo " search: $scientificNameSearch <br>";
     echo "<pre>---------<br>";
              //verifica se tem mesmo nome
              echo "<pre><br>";
              echo "$scientificNameSource = $scientificNameSearch <br>";
              echo "conta source array=";
              echo count($explodeNameSource);
              echo "<br>posicao=$foundSppSource";
              echo "<br>conta search array=";
              echo count($explodeNameSearch);
              echo "<br>posicao=$foundSppSearch";
              //echo $explodeNameSource[$foundSppSource]."=".$explodeNameSearch[$foundSppSearch];
              echo "<br></pre>";
   //  }
     return $found;
  }



}

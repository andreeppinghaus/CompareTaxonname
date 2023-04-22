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
        //echo "<pre>subsp. nao existe = $scientificNameSearch </pre>";
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
  
         // echo "\n encontrou genero e epiteto";
         
         //existe subspecie ?
       // erro aqui tem que retornar falso se uma das duas cndicoes foram verdadeiras
        if ($foundSppSearch !== false && $foundSppSource !== false) {
         // echo "\n encontrou subsp. nos dois";
         // echo "\n source: ".$explodeNameSource[$foundSppSource+1];
         // echo "\n search: ".$explodeNameSearch[$foundSppSearch+1];

            if ($explodeNameSource[$foundSppSource+1]==$explodeNameSearch[$foundSppSearch+1]) {
               // echo "\n encontrou nome";
               $found=true;
            }else {
               // echo "\n nao encontrou nome";
               $found=false; //nao tem o mesmo nome
            }
           
        }else if ($foundSppSearch !== false || $foundSppSource !== false) {
         //   echo '\n nao existe spp e var';
            $found=false;
        }//fim verifica subespecie

         //existe variedade ?
        if ($foundVarSearch !== false && $foundVarSource !== false) {
      //   echo "\n encontrou var. nos dois";
      //   echo "\n source: ".$explodeNameSource[$foundSppSource+1];
      //   echo "\n search: ".$explodeNameSearch[$foundSppSearch+1];

              //verifica se tem mesmo nome
              if ($explodeNameSource[$foundSppSource+1]==$explodeNameSearch[$foundSppSearch+1]) {
                  // echo "\n encontrou nome var.";
                  $found=true;
              }else {
                  // echo "\n nao encontrou nome var.";
                  $found=false; //nao existe o mesmo nome
             }
          
        }else if ($foundVarSearch !== false || $foundVarSource !== false) {
         // echo "\n nao encontrou variedade";
            $found=false;
        }//fim verifica variedade
     }//fim verifica generoe epiteto
     
     return $found;
  }



}

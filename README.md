# CompareTaxonname
Compare taxons names with Gender, Epithet, subsp., var.

## Install 
composer require andreeppinghaus/compare-taxon-name

## Example


use CompareTaxonName\CompareTaxonName;

$compareTaxonName = new CompareTaxonName();
$scientificNameSource = "Caryocar glabrum (Aubl.) Pers. subsp. glabrum (Aubl.) Pers.";
$scientificNameSearch = "Caryocar glabrum (Aubl.) Pers. subsp. glabrum (Aubl.) Pers.";

if ( $compareTaxonName->compare(
                $scientificNameSource,
                $scientificNameSearch
                ) ) {
                    echo "found";
                }else {
                    echo "not found";
                }

<?php declare(strict_types=1);
require_once __DIR__ . '/../autoload.php'; 

use PHPUnit\Framework\TestCase;
use CompareTaxonName\CompareTaxonName;

final class CompareTaxonNameTest extends TestCase
{

    private static $compareTaxonName;

    public static function setUpBeforeClass(): void
    {
        self::$compareTaxonName = new CompareTaxonName();
    }

    /**
     * @dataProvider additionProvider
     */
    public function testCompare(string $scientificNameSource, 
                                string $scientificNameSearch, 
                                bool $expected
                                ): void
    {
        $this->assertSame(
            $expected, 
            self::$compareTaxonName->compare(
                $scientificNameSource,
                $scientificNameSearch
                )
            );
    }

    public function additionProvider(): array
    {
        $search = "Caryocar brasiliense subsp. intermedium (Wittm.) Prance & Freitas";
        $search = "Caryocar glabrum2 var. testname (Aubl.) Pers.";

        return [
            [
                "Caryocar brasiliense subsp. intermedium (Wittm.) Prance & Freitas",
                $search, 
                false
            ],
            [
                "Caryocar cuneatum Wittm.",
                $search, 
                false
            ],
            [
                "Caryocar dentatum Gleason",
                $search, 
                false
            ],
            [
                "Caryocar glabrum (Aubl.) Pers.",
                $search, 
                false
            ],
            [
                "Caryocar glabrum subsp. album Prance & M.F.Silva",
                $search, 
                false
            ],
            [
                "Caryocar glabrum subsp. parviflorum (A.C.Sm.) Prance & M.F.Silva",
                $search, 
                false
            ],
            [
                "Caryocar gracile Wittm.",
                $search, 
                false
            ],
            [
                "Caryocar microcarpum Ducke",
                $search, 
                false
            ],
            [
                "Caryocar montanum Prance",
                $search, 
                false
            ],
            [
                "Caryocar nuciferum L.",
                $search, 
                false
            ],
            [
                "Caryocar pallidum A.C.Sm.",
                $search, 
                false
            ],
            [
                "Caryocar villosum (Aubl.) Pers.",
                $search, 
                false
            ],
            [
                "Caryocar glabrum subsp. glabrum (Aubl.) Pers.",
                $search, 
                false
            ],
            [
                "Caryocar glabrum (Aubl.) Pers. subsp. glabrum (Aubl.) Pers.",
                $search, 
                false
            ],
            [
                "Caryocar glabrum2 (Aubl.) Pers. subsp. glabrum1 var. testname (Aubl.) Pers.",
                $search, 
                false
            ],
            [
                "Caryocar glabrum2 var. testname (Aubl.) Pers.",
                $search, 
                true
            ],
           
        ];
    }

}

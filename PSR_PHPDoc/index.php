<?php 

class Calculator
{
    /**
     * Undocumented variable
     *
     * @var integer
     */
    private int $dividende;

    /**
     * Undocumented variable
     *
     * @var integer
     */
    private int $diviseur;

    
    public function __construct()
    {
        
    }

    /**
     * Undocumented function
     *
     * @param integer $dividende
     * @param integer $diviseur
     * @return integer|float
     */
    public function divise(int $dividende, float $diviseur) : int|float
    {
        if ($diviseur === 0){
            throw new Exception("Le diviseur ne peut être null");
        }
        return ($dividende / $diviseur);
    }

}
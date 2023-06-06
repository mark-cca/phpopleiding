<?php

class BMICalculator {
    /**
     * De lengte van de persoon in meters.
     *
     * @var float
     */
    private $length;

    /**
     * Het gewicht van de persoon in kilogram.
     *
     * @var float
     */
    private $weight;

    /**
     * BMICalculator constructor.
     *
     * @param float $length De lengte van de persoon in meters.
     * @param float $weight Het gewicht van de persoon in kilogram.
     */
    public function __construct($length, $weight) {
        $this->length = $length;
        $this->weight = $weight;
    }

    /**
     * Bereken de BMI waarde.
     *
     * @return float De berekende BMI waarde.
     */
    public function calculate() {
        $bmi = $this->weight / ($this->length * $this->length);
        return round($bmi, 2);
    }

    /**
     * Geeft de gezondheidsstatus op basis van de berekende BMI waarde.
     *
     * @return string De gezondheidsstatus.
     */
    public function getStatus() {
        $bmi = $this->calculate();

        if ($bmi < 18.5) {
            return 'Ondergewicht (te laag gewicht)';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return 'Gezond gewicht';
        } elseif ($bmi >= 25 && $bmi < 30) {
            return 'Overgewicht';
        } else {
            return 'Ernstig overgewicht (obesitas)';
        }
    }
}

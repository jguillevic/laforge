<?php

namespace Model\Day;

/**
 * @author JGuillevic
 */
class Day
{
    const MON = 'MONDAY';
    const TUE = 'TUESDAY';
    const WED = 'WEDNESDAY';
    const THU = 'THURSDAY';
    const FRI = 'FRIDAY';
    const SAT = 'SATURDAY';
    const SUN = 'SUNDAY';

    private $id;
    private $code;

    public function GetId()
    {
        return $this->id;
    }
    
    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetCode()
    {
        return $this->code;
    }

    public function SetCode($code)
    {
        $this->code = $code;
    }

    public function GetLabel()
    {
        switch ($this->code)
        {
            case SELF::MON:
                return 'Lundi';
            case SELF::TUE:
                return 'Mardi';
            case SELF::WED:
                return 'Mercredi';
            case SELF::THU:
                return 'Jeudi';
            case SELF::FRI:
                return 'Vendredi';
            case SELF::SAT:
                return 'Samedi';
            case SELF::SUN:
                return 'Dimanche';
            default:
                throw new Exception('Not implemented.');
        }
    }
}
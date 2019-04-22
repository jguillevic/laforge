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
    private $label;

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
        return $this->label;
    }

    public function SetLabel($label)
    {
        $this->label = $label;
    }
}
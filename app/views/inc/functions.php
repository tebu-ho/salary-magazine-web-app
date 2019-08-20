<?php
class formOptions
{
    public $area = 'Khetha';
    public function selectOption() {
        if (empty($data['ngowantoni'])) {
            return '<option class="form-control" value="' . $this->area . '">' . $this->area . '</option>';
        } else {
            return '<option class="form-control" value="' . $data['ngownatoni'] . '">' . $data['ngownatoni'] . '</option>';
        }
        if (empty($data['mfundo'])) {
            return '<option class="form-control" value="' . $this->area . '">' . $this->area . '</option>';
        } else {
            return $area = $data['mfundo'];
        }
        if (empty($data['experience'])) {
            return '<option class="form-control" value="' . $this->area . '">' . $this->area . '</option>';
        } else {
            return $area = $data['experience'];
        }
        if (empty($data['province'])) {
            return '<option class="form-control" value="' . $this->area . '">' . $this->area . '</option>';
        } else {
            return $area = $data['province'];
        }
        if (empty($data['msebenzi_onjani'])) {
            return '<option class="form-control" value="' . $this->area . '">' . $this->area . '</option>';
        } else {
            return $area = $data['msebenzi_onjani'];
        }
    }
}

class Provinces 
{
    public $provinces = [
        'Eastern Cape',
        'Free State',
        'Gauteng',
        'KwaZuu-Natal',
        'Limpopo',
        'Mpumalanga',
        'North West',
        'Northern Cape',
        'Western Cape'
    ];
}
   
function createSlug($slug)
{
    $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
    $duplicateHyphensAndSpaces = '/[\-\s]+/';
    $slug = preg_replace($lettersNumbersSpacesHyphens, '', mb_strtolower($slug, 'UTF-8'));
    $slug = preg_replace($duplicateHyphensAndSpaces, '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

class Convert
{
    public $nge = '';
    public $ka = '';
    public function convertDayDate($day)
    {
        $this->nge = date('j', strtotime($day));
        return $this->nge;
    }
    public function convertMonthYear($year) 
    {
        $this->ka = date('F Y', strtotime($year));
        return $this->ka;
    }
}
?>
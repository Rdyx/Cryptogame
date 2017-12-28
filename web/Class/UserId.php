<?php

class UserId
{
    private $name;
    private $totalCallNumber;
    private $successCall;
    private $score;
    private $BTCAdress;
    private $ETHAdress;
    private $LTCAdress;
    private $html;

    public function __construct($name, $totalCallNumber, $successCall, $score,
                                $BTCAdress, $ETHAdress, $LTCAdress)
    {
        $this->setName($name);
        $this->setTotalCallNumber($totalCallNumber);
        $this->setSuccessCall($successCall);
        $this->setScore($score);
        $this->setBTCAdress($BTCAdress);
        $this->setETHAdress($ETHAdress);
        $this->setLTCAdress($LTCAdress);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTotalCallNumber()
    {
        return $this->totalCallNumber;
    }

    /**
     * @param mixed $totalCallNumber
     */
    public function setTotalCallNumber($totalCallNumber)
    {
        $this->totalCallNumber = $totalCallNumber;
    }

    /**
     * @return mixed
     */
    public function getSuccessCall()
    {
        return $this->successCall;
    }

    /**
     * @param mixed $successCall
     */
    public function setSuccessCall($successCall)
    {
        $this->successCall = $successCall;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getBTCAdress()
    {
        return $this->BTCAdress;
    }

    /**
     * @param mixed $BTCAdress
     */
    public function setBTCAdress($BTCAdress)
    {
        $this->BTCAdress = $BTCAdress;
    }

    /**
     * @return mixed
     */
    public function getETHAdress()
    {
        return $this->ETHAdress;
    }

    /**
     * @param mixed $ETHAdress
     */
    public function setETHAdress($ETHAdress)
    {
        $this->ETHAdress = $ETHAdress;
    }

    /**
     * @return mixed
     */
    public function getLTCAdress()
    {
        return $this->LTCAdress;
    }

    /**
     * @param mixed $LTCAdress
     */
    public function setLTCAdress($LTCAdress)
    {
        $this->LTCAdress = $LTCAdress;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml()
    {
        if($_SESSION['nick'] === $this->getName()){
            $editAndSuppr = '<tr>
                                <td colspan="2"><a class="col" href="/web/editUser.php/?callId='.$this->getName().'">Editer votre profil</a></td>
                             </tr>';
        } else {
            $editAndSuppr = '';
        }

        $this->html = '<div class="container-fluid black-div underTopDiv">
    <div class="container-fluid knowMore mb-3 mt-2 pb-1"><h1>Profil de '.$this->getName().'</h1></div>
    <div class="knowMore mb-5 pb-0 container col border justify-content-around">
        <table class="col table text-center table-bordered">
            '.$editAndSuppr.'
            <tr>
                <th class="text-center">Pseudo</th>
                <td><strong>'.$this->getName().'</strong></td>
            </tr>
            <tr>
                <th class="text-center">Nombre total de calls</th>
                <td class="green">'.$this->getTotalCallNumber().'</td>
            </tr>
            <tr>
                <th class="text-center">Calls réussis</th>
                <td class="green">'.$this->getSuccessCall().'</td>
            </tr>
            <tr>
                <th class="text-center">Scoring</th>
                <td class="green">'.$this->getScore().'%</td>
            </tr>';
        if($this->getBTCAdress() !== null){
            $BTCAdress = $this->getBTCAdress();
            $this->html .= $this->adress('Adresse BTC', $BTCAdress);
        };
        if($this->getETHAdress() !== null){
            $ETHAdress = $this->getETHAdress();
            $this->html .=  $this->adress('Adresse ETH', $ETHAdress);
        };
        if($this->getLTCAdress() !== null){
            $LTCAdress = $this->getLTCAdress();
            $this->html .=  $this->adress('Adresse LTC', $LTCAdress);
        };
        $this->html .= '
        </table>
    </div>';
    }

    private function adress($arg1, $arg2){
        return '<tr>
                    <th class="text-center">'.$arg1.'</th>
                    <td>'.$arg2.'</td>
                </tr>';
    }
}
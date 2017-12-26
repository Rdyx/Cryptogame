<?php

class UserId
{
    private $name;
    private $totalCallNumber;
    private $successCall;
    private $score;
    private $html;

    public function __construct($name, $totalCallNumber, $successCall, $score)
    {
        $this->setName($name);
        $this->setTotalCallNumber($totalCallNumber);
        $this->setSuccessCall($successCall);
        $this->setScore($score);
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
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml()
    {
        $this->html = '<div class="container-fluid black-div underTopDiv">
    <div class="container-fluid mb-2 mt-2 pb-1"><h1>Profil de '.$this->getName().'</h1></div>
    <div class="knowMore mb-5 pb-0 container col border justify-content-around">
        <table class="table">
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
            </tr>
        </table>
    </div>';
    }
}
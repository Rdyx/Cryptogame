<?php

class CallId
{
    private $caller;
    private $crypto;
    private $cryptoURL;
    private $callTime;
    private $callStart;
    private $callStatus;
    private $score;
    private $callStartTime;
    private $callTarget;
    private $html;

    /**
     * @return mixed
     */
    public function getCaller()
    {
        return $this->caller;
    }

    /**
     * @param mixed $caller
     */
    public function setCaller($caller)
    {
        $this->caller = $caller;
    }

    /**
     * @return mixed
     */
    public function getCrypto()
    {
        return $this->crypto;
    }

    /**
     * @param mixed $crypto
     */
    public function setCrypto($crypto)
    {
        $this->crypto = $crypto;
    }

    /**
     * @return mixed
     */
    public function getCryptoURL()
    {
        return $this->cryptoURL;
    }

    /**
     * @param mixed $cryptoURL
     */
    public function setCryptoURL($cryptoURL)
    {
        $this->cryptoURL = $cryptoURL;
    }

    /**
     * @return mixed
     */
    public function getCallTime()
    {
        return $this->callTime;
    }

    /**
     * @param mixed $callTime
     */
    public function setCallTime($callTime)
    {
        $this->callTime = $callTime;
    }

    /**
     * @return mixed
     */
    public function getCallStart()
    {
        return $this->callStart;
    }

    /**
     * @param mixed $callStart
     */
    public function setCallStart($callStart)
    {
        $this->callStart = $callStart;
    }

    /**
     * @return mixed
     */
    public function getCallStatus()
    {
        return $this->callStatus;
    }

    /**
     * @param mixed $callStatus
     */
    public function setCallStatus($callStatus)
    {
        $this->callStatus = $callStatus;
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
    public function getCallStartTime()
    {
        return $this->callStartTime;
    }

    /**
     * @param mixed $callStartTime
     */
    public function setCallStartTime($callStartTime)
    {
        $this->callStartTime = $callStartTime;
    }

    /**
     * @return mixed
     */
    public function getCallTarget()
    {
        return $this->callTarget;
    }

    /**
     * @param mixed $callTarget
     */
    public function setCallTarget($callTarget)
    {
        $this->callTarget = $callTarget;
    }

    public function __construct($caller, $crypto, $cryptoURL, $callTime, $callStart, $callStatus, $score, $callStartTime, $callTarget)
    {
        $this->setCaller($caller);
        $this->setCrypto($crypto);
        $this->setCryptoURL($cryptoURL);
        $this->setCallTime($callTime);
        $this->setCallStart($callStart);
        $this->setCallStatus($callStatus);
        $this->setScore($score);
        $this->setCallStartTime($callStartTime);
        $this->setCallTarget($callTarget);
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
        $this->html = '<div id="topCalls" class="container-fluid black-div underTopDiv">
    <div class="container-fluid mb-2 mt-2 pb-1"><h1>Call de '.$this->getCaller().'</h1></div>
        <div class="container col border justify-content-around">
            <table class="table">
                <tr>
                    <th class="text-center">Caller</th>
                    <td><a href="/web/user.php/?userId='.$this->getCaller().'">'.$this->getCaller().'</a></td>
                </tr>

                <tr>
                    <th class="text-center">Crypto</th>
                    <td><a href="'.$this->getCryptoURL().'">'.$this->getCrypto().'</a></td>
                </tr>
                <tr>
                    <th class="text-center">Début du call</th>
                    <td>'.$this->getCallStartTime().'</td>
                </tr>
                <tr>
                    <th class="text-center">Durée du call</th>
                    <td>'.$this->getCallTime().'</td>
                </tr>
                <tr>
                    <th class="text-center">Départ</th>
                    <td>'.$this->getCallStart().' sats</td>
                </tr>
                <tr>
                    <th class="text-center">Statut</th>
                    <td>'.$this->getCallStatus().'</td>
                </tr>
                <tr>
                    <th class="text-center">Scoring du caller</th>
                    <td class="green">'.$this->getScore().'%</td>
                </tr>
                <tr>
                    <th class="text-center">Target</th>
                    <td>'.$this->getCallTarget().' sats</td>
                </tr>
            </table>
            <div class="knowMore"><a href="/web/index.php">Retourner à l\'accueil </a ></div >
        </div >';
    }
}

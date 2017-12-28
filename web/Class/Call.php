<?php

class Call
{
    private $callId;
    private $caller;
    private $crypto;
    private $cryptoURL;
    private $callTime;
    private $callStartPrice;
    private $callStatus;
    private $callTarget;
    private $callStartTime;
    private $html;

    public function __construct($callId, $caller, $crypto, $cryptoURL, $callTime, $callStartPrice, $callStatus, $callTarget, $callStartTime)
    {
        $this->setCallId($callId);
        $this->setCaller($caller);
        $this->setCrypto($crypto);
        $this->setCryptoURL($cryptoURL);
        $this->setCallTime($callTime);
        $this->setCallStartPrice($callStartPrice);
        $this->setCallStatus($callStatus);
        $this->setCallTarget($callTarget);
        $this->setCallStartTime($callStartTime);
    }

    /**
     * @return string
     */
    public function getCaller(): string
    {
        return $this->caller;
    }

    /**
     * @param string $caller
     */
    public function setCaller(string $caller)
    {
        $this->caller = $caller;
    }

    /**
     * @return string
     */
    public function getCrypto(): string
    {
        return $this->crypto;
    }

    /**
     * @param string $crypto
     */
    public function setCrypto(string $crypto)
    {
        $this->crypto = $crypto;
    }

    /**
     * @return string
     */
    public function getCallTime(): string
    {
        return $this->callTime;
    }

    /**
     * @param string $callTime
     */
    public function setCallTime(string $callTime)
    {
        $this->callTime = $callTime;
    }

    /**
     * @return string
     */
    public function getCallStartPrice(): string
    {
        return $this->callStartPrice;
    }

    /**
     * @param string $callStartPrice
     */
    public function setCallStartPrice(string $callStartPrice)
    {
        $this->callStartPrice = $callStartPrice;
    }

    /**
     * @return string
     */
    public function getCallStatus(): string
    {
        return $this->callStatus;
    }

    /**
     * @param string $callStatus
     */
    public function setCallStatus(string $callStatus)
    {
        $this->callStatus = $callStatus;
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
    public function getCallId()
    {
        return $this->callId;
    }

    /**
     * @param mixed $callId
     */
    public function setCallId($callId)
    {
        $this->callId = $callId;
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
        if($_SESSION['nick'] === $this->getCaller()){
            $editAndSuppr = '<tr>
                                <td colspan="2"><a class="col" href="/web/edit.php/?callId='.$this->getCallId().'">Editer</a><a class="col" href="/web/delete.php/?callId='.$this->getCallId().'">Supprimer</a></td>
                             </tr>';
        } else {
            $editAndSuppr = '';
        }

        $this->html = '<div class="col-sm-4 border">
                        <table class="table table-bordered text-center">
                            <tr>
                                <th class="text-center">Caller</th>
                                <td><a href="/web/user.php/?userId='.$this->getCaller().'">' . $this->getCaller() . '</a></td>
                            </tr>
                            <tr>
                                <th class="text-center">Crypto</th>
                                <td><a href="' . $this->getCryptoURL() . '">' . $this->getCrypto() . '</a></td>
                            </tr>
                            <tr>
                                <th class="text-center">Début du call</th>
                                <td>' . $this->getCallStartTime() . '</td>
                            </tr>
                            <tr>
                                <th class="text-center">Fin du call</th>
                                <td>' . $this->getCallTime() . '</td>
                            </tr>
                            <tr>
                                <th class="text-center">Départ</th>
                                <td>' . $this->getCallStartPrice() . '</td>
                            </tr>
                            <tr>
                                <th class="text-center">Target</th>
                                <td>' . $this->getCallTarget() . '</td>
                            </tr>
                            <tr>
                                <th class="text-center">Statut</th>
                                <td>' . $this->getCallStatus() . '</td>
                            </tr>
                            '.$editAndSuppr.'
                        </table>
                        <div class="knowMore"><a href="/web/callId.php/?callId='.$this->getCallId().'">En savoir plus</a></div>
                    </div>';
    }
}
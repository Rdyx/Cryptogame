<?php

class Call
{
    private $caller;
    private $crypto;
    private $cryptoURL;
    private $callTime;
    private $callStartPrice;
    private $callStatus;
    private $html;

    public function __construct($caller, $crypto, $cryptoURL, $callTime, $callStartPrice, $callStatus){
        $this->setCaller($caller);
        $this->setCrypto($crypto);
        $this->setCryptoURL($cryptoURL);
        $this->setCallTime($callTime);
        $this->setCallStartPrice($callStartPrice);
        $this->setCallStatus($callStatus);
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
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     */
    public function setHtml()
    {
        $this->html = '<div class="col-sm-4 border">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center">Caller</th>
                                <td><a href="prophete.html">' . $this->getCaller() . '</a></td>
                            </tr>
                            <tr>
                                <th class="text-center">Crypto</th>
                                <td><a href="' . $this->getCryptoURL() . '">' . $this->getCrypto() . '</a></td>
                            </tr>
                            <tr>
                                <th class="text-center">Durée du call</th>
                                <td>' . $this->getCallTime() . '</td>
                            </tr>
                            <tr>
                                <th class="text-center">Départ</th>
                                <td>' . $this->getCallStartPrice() . '</td>
                            </tr>
                            <tr>
                                <th class="text-center">Statut</th>
                                <td>' . $this->getCallStatus() . '</td>
                            </tr>
                        </table>
                        <div class="knowMore"><a href="art1.html">En savoir plus</a></div>
                    </div>';
    }
}
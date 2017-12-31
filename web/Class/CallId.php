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
    private $lastHour;
    private $last24Hours;
    private $last7Days;
    private $marketcap;
    private $fiatValue;
    private $supply;
    private $volume;
    private $description;
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

    /**
     * @return mixed
     */
    public function getLastHour()
    {
        return $this->lastHour;
    }

    /**
     * @param mixed $lastHour
     */
    public function setLastHour($lastHour)
    {
        $this->lastHour = $lastHour;
    }

    /**
     * @return mixed
     */
    public function getLast24Hours()
    {
        return $this->last24Hours;
    }

    /**
     * @param mixed $last24Hours
     */
    public function setLast24Hours($last24Hours)
    {
        $this->last24Hours = $last24Hours;
    }

    /**
     * @return mixed
     */
    public function getLast7Days()
    {
        return $this->last7Days;
    }

    /**
     * @param mixed $last7Days
     */
    public function setLast7Days($last7Days)
    {
        $this->last7Days = $last7Days;
    }

    /**
     * @return mixed
     */
    public function getMarketcap()
    {
        return $this->marketcap;
    }

    /**
     * @param mixed $marketcap
     */
    public function setMarketcap($marketcap)
    {
        $this->marketcap = $marketcap;
    }

    /**
     * @return mixed
     */
    public function getFiatValue()
    {
        return $this->fiatValue;
    }

    /**
     * @param mixed $fiatValue
     */
    public function setFiatValue($fiatValue)
    {
        $this->fiatValue = $fiatValue;
    }

    /**
     * @return mixed
     */
    public function getSupply()
    {
        return $this->supply;
    }

    /**
     * @param mixed $supply
     */
    public function setSupply($supply)
    {
        $this->supply = $supply;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function __construct($caller, $crypto, $cryptoURL, $callTime, $callStart,
                                $callStatus, $score, $callStartTime, $callTarget, $lastHour,
                                $last24Hours, $last7Days, $marketcap, $fiatValue, $supply, $volume, $description)
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
        $this->setLastHour($lastHour);
        $this->setLast24Hours($last24Hours);
        $this->setLast7Days($last7Days);
        $this->setMarketcap($marketcap);
        $this->setFiatValue($fiatValue);
        $this->setSupply($supply);
        $this->setVolume($volume);
        $this->setDescription($description);
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
        if ($this->getLastHour() <= 0) {
            $lastHour = 'red';
        } else {
            $lastHour = 'green';
        }

        if ($this->getLast24Hours() <= 0) {
            $last24Hours = 'red';
        } else {
            $last24Hours = 'green';
        }

        if ($this->getLast7Days() <= 0) {
            $last7days = 'red';
        } else {
            $last7days = 'green';
        }

        if ($this->getDescription() !== null){
            $description = '<tr>
                    <th class="text-center">Infos supplémentaires</th>
                    <td><strong>'.$this->getDescription().'</strong></td>
                </tr>';
        } else {
            $description = '';
        }

        $this->html = '<div class="container-fluid black-div underTopDiv">
    <div class="container-fluid knowMore mb-3 mt-2 pb-1"><h1>Call de '.$this->getCaller().'</h1></div>
        <div class="container col border justify-content-around">
            <table class="table text-center">
                '.$description.'
                <tr>
                    <th class="text-center">Caller</th>
                    <td><a href="/web/user.php/?userId='.$this->getCaller().'">'.$this->getCaller().'</a></td>
                </tr>
                <tr>
                    <th class="text-center">Scoring du caller</th>
                    <td class="green">'.$this->getScore().'%</td>
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
                    <th class="text-center">Fin du call</th>
                    <td>'.$this->getCallTime().'</td>
                </tr>
                <tr>
                    <th class="text-center">Départ</th>
                    <td>'.$this->getCallStart().'</td>
                </tr>
                <tr>
                    <th class="text-center">Target</th>
                    <td>'.$this->getCallTarget().'</td>
                </tr>
                <tr>
                    <th class="text-center">Statut</th>
                    <td>'.$this->getCallStatus().'</td>
                </tr>
                <tr>
                    <th class="text-center align-middle">Variation</th>
                    <td>
                        <ul class="list-inline mb-0 hidden-md-down">
                            <li class="list-inline-item borderRightTopDiv mr-3 pr-3 '.$lastHour.'">1h : '.$this->getLastHour().'</li>
                            <li class="list-inline-item borderRightTopDiv mr-3 pr-3 '.$last24Hours.'">24h : '.$this->getLast24Hours().'</li>
                            <li class="list-inline-item '.$last7days.'">7j : '.$this->getLast7Days().'</li>
                        </ul>
                        <ul class="list-unstyled mb-0 hidden-md-up">
                            <li class="'.$lastHour.'">1h : '.$this->getLastHour().'</li>
                            <li class="'.$last24Hours.'">24h : '.$this->getLast24Hours().'</li>
                            <li class="'.$last7days.'">7j : '.$this->getLast7Days().'</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">Marketcap</th>
                    <td>'.$this->getMarketcap().'</td>
                </tr>
                <tr>
                    <th class="text-center">Valeur</th>
                    <td>'.$this->getFiatValue().'</td>
                </tr>
                <tr>
                    <th class="text-center">Supply</th>
                    <td>'.$this->getSupply().'</td>
                </tr>
                <tr>
                    <th class="text-center">Volume</th>
                    <td>'.$this->getVolume().'</td>
                </tr>
            </table>
            <div class="knowMore"><a href="/web/index.php">Retourner à l\'accueil </a ></div >
        </div >';
    }
}

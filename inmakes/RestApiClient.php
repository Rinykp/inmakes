<?php

class RestApiClient
{

    private $apiUrl;
    private $cacheFile;
    private $cacheTimeout;

    /**
     * Constructor method that takes the URL of the REST API as an argument.
     *
     * @param string $apiUrl 
     * @param int $cacheTimeout 
     */
    public function __construct($apiUrl, $cacheTimeout = 300)
    {
        $this->apiUrl = $apiUrl;
        $this->cacheFile = sys_get_temp_dir() . '/rest-api-cache-' . md5($apiUrl);
        $this->cacheTimeout = $cacheTimeout;
    }

    /**
     * Public method called getData that retrieves the data from the API.
     *
     * @return mixed 
     * @throws Exception 
     */
    public function getData()
    {
        $data = $this->getCachedData();
        if (!$data) {
            $data = $this->fetchDataFromApi();
            $this->cacheData($data);
        }
        return $data;
    }

    /**
     * checks if the data is already cached.
     *
     * @return mixed The cached data, or false if it is not cached.
     */
    private function getCachedData()
    {
        if (file_exists($this->cacheFile) && time() - filemtime($this->cacheFile) < $this->cacheTimeout) {
            return json_decode(file_get_contents($this->cacheFile), true);
        }
        return false;
    }

    /**
     *
     *
     * @return mixed 
     * @throws Exception 
     */
    private function fetchDataFromApi()
    {
        $ch = curl_init($this->apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception('API returned HTTP status code ' . $httpCode);
        }

        $data = json_decode($response, true);
        if (!$data) {
            throw new Exception('Failed to decode response from API: ' . $response);
        }

        return $data;
    }

    /**
     * 
     *
     * @param mixed $data The data to cache.
     */
    private function cacheData($data)
    {
        file_put_contents($this->cacheFile, json_encode($data));
    }
}

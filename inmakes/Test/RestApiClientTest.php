<?php 
namespace Test;
use PHPUnit\Framework\TestCase;
  // Unit tests
class RestApiClientTest extends TestCase {

    public function testGetData() {
      // Set up a mock API
      $mockApiUrl = 'https://mockapi.io/api/v1/test';
      $mockApiResponse = [
        'id' => 133,
        'name' => 'Tests Data'
      ];
      $mockApi = $this->getMockBuilder(\RestApiClient::class)
        ->setConstructorArgs([$mockApiUrl])
        ->setMethods(['fetchDataFromApi', 'cacheData', 'getCachedData'])
        ->getMock();
  
        
    //   $mockApi->expects($this->once())->
    //     
  
    }
}
?>
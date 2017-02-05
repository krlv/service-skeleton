<?php
namespace Skeleton\Test\Functional;

use Skeleton\App\AppFactory;
use Skeleton\App\SkeletonApp;

/**
 * Base class functional tests
 */
class WebTestCase extends \PHPUnit\Framework\TestCase
{
    /**
    * Application instance
    *
    * @var SkeletonApp
    */
    protected $app;

    /**
     *
     *
     * @var WebTestClient
     */
    protected $client;

    /**
     * Setting up test environment
     */
    public static function setUpBeforeClass()
    {
        //TODO: init database
    }

    /**
    * Setting up the application
    */
    protected function setUp()
    {
        $this->app = $this->createApplication();
        //TODO: init database tables
        $this->client = $this->createClient();
    }

    /**
    * Creates the application
    *
    * @return SkeletonApp
    */
    public function createApplication()
    {
        return AppFactory::createTestApp(require __DIR__ . '/../../src/settings.php');
    }

    /**
    * Creates a Client
    *
    * @param array $server Server parameters
    *
    * @return WebTestClient A Client instance
    */
    public function createClient(array $server = array())
    {
        return new WebTestClient($this->app, $server);
    }

    /**
     * Assert that response status equals to expected code
     *
     * @param $code
     */
    public function assertStatusCode($code)
    {
        $this->assertEquals($code, $this->client->getStatusCode());
    }

    /**
     * Assert that response content type equals to expected content type
     *
     * @param $type
     */
    public function assertContentType($type)
    {
        $this->assertContains($type, $this->client->getHeader('Content-Type'));
    }

    /**
     * Assert that JSON response equals to expected data
     *
     * @param array $expected
     * @param int $code
     */
    public function assertJsonResponse(array $expected, $code = 200)
    {
        $this->assertStatusCode($code);
        $this->assertContentType('application/json;charset=utf-8');

        $expected = json_encode($expected);
        $actual   = $this->client->getResponse();
        $this->assertEquals($expected, $actual);
    }
}

<?php

namespace Demontpx\UtilBundle\Test;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\HttpFoundation\Response;

/**
 * @copyright 2014 Bert Hekman
 */
abstract class WebTestCase extends BaseWebTestCase
{
    use UserClientTrait;
    use RethrowControllerExceptionTrait;
    use ResetStateAfterTestTrait;

    /** @var Client */
    protected $client;

    /** @var Response */
    protected $response;

    /** @var Crawler */
    protected $crawler;

    protected function setUpClient(?string $username = null)
    {
        if ($username) {
            $this->client = static::createClientForUser($username);
        } else {
            $this->client = static::createClient();
        }
    }

    protected function navigate(string $url, int $expectedResponseCode = Response::HTTP_OK): Crawler
    {
        $this->ensureClient();

        $this->crawler = $this->client->request('GET', $url);
        $this->response = $this->client->getResponse();

        $this->rethrowControllerException();
        $this->assertSame($expectedResponseCode, $this->response->getStatusCode(), sprintf('Response code for path "%s" was not %d', $url, $expectedResponseCode));

        return $this->crawler;
    }

    protected function click(Link $link, int $expectedResponseCode = Response::HTTP_OK)
    {
        $this->ensureClient();

        $this->crawler = $this->client->click($link);
        $this->response = $this->client->getResponse();

        $this->rethrowControllerException();
        $this->assertSame($expectedResponseCode, $this->response->getStatusCode(), sprintf('Response code for clicked link with url "%s" was not %d', $link->getUri(), $expectedResponseCode));

        return $this->crawler;
    }

    protected function submit(Form $form, bool $expectRedirect = true, int $expectedResponseCode = Response::HTTP_OK): Crawler
    {
        $this->ensureClient();

        $this->crawler = $this->client->submit($form);
        $this->response = $this->client->getResponse();

        $this->rethrowControllerException();

        if ($expectRedirect) {
            $this->assertTrue($this->response->isRedirection(), sprintf('Response form submitted form with url "%s" was not a redirect', $form->getUri()));

            $this->crawler = $this->client->followRedirect();
            $this->rethrowControllerException();

            $this->response = $this->client->getResponse();
        }

        $this->assertSame($expectedResponseCode, $this->response->getStatusCode(), sprintf('Response code for submitted form with url "%s" was not %d', $form->getUri(), $expectedResponseCode));

        return $this->crawler;
    }

    private function ensureClient()
    {
        if ($this->client) {
            return;
        }

        $username = $this->getUsernameFromAnnotation('method') ?? $this->getUsernameFromAnnotation('class');
        $this->setUpClient($username);
    }

    private function getUsernameFromAnnotation(string $type): ?string
    {
        $list = $this->getAnnotations();

        if ( ! isset($list) && ! isset($list[$type]) && ! isset($list[$type]['user'])) {
            return null;
        }

        $userList = $list[$type]['user'];

        if (count($userList) !== 1) {
            throw new \LogicException(sprintf(
                'Only one @user annotation should be configured for test "%s::%s"',
                static::class,
                $this->getName()
            ));
        }

        return $userList[0];
    }
}

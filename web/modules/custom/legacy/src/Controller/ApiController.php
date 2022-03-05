<?php

declare(strict_types=1);

namespace Drupal\legacy\Controller;

use Drupal\legacy\Action\ValidatesTheAccessToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ApiController {

  private static array $data = [
    'items' => [
      1 => [
        'title' => 'TDD: Test-Driven Drupal',
        'description' => 'How to write automated tests for Drupal, and how to create a new Drupal module using test driven development.',
        'slides' => [
          'id' => '088cb18033064f5cb18d1079795294a1',
          'ratio' => '1.77777777777778',
          'url' => 'https://speakerdeck.com/opdavies/tdd-test-driven-drupal',
        ],
        'video' => [
          'type' => 'youtube',
          'id' => 'r41dkD2EOo8',
        ],
        'events' => [
          [
            'name' => 'DrupalCamp London 2017',
            'location' => 'London, UK',
            'date' => '2017-03-04',
            'time' => '16:15 - 17:00',
            'url' => NULL,
            'online' => FALSE,
          ],
          [
            'name' => 'DrupalCamp Dublin 2017',
            'location' => 'Dublin, Ireland',
            'date' => '2017-10-21',
            'time' => '12:00 - 12:40',
            'url' => 'http://2017.drupal.ie',
            'online' => FALSE,
          ],
          [
            'name' => 'Drupal Bristol',
            'date' => '2017-11-22',
            'location' => 'Bristol, UK',
            'url' => 'https://www.drupalbristol.org.uk',
            'online' => FALSE,
          ],
          [
            'name' => 'Drupal Somerset',
            'date' => '2018-06-14',
            'location' => 'Glastonbury, UK',
            'url' => NULL,
            'online' => FALSE,
          ],
          [
            'name' => 'Drupal Developer Days 2018',
            'date' => '2018-07-05',
            'time' => '12:15 - 13:00',
            'location' => 'Lisbon, Portugal',
            'url' => 'http://lisbon2018.drupaldays.org',
            'online' => FALSE,
          ],
          [
            'name' => 'DrupalCamp London 2019',
            'date' => '2019-03-02',
            'time' => '14:00 - 14:45',
            'location' => 'London, UK',
            'url' => 'http://drupalcamp.london',
            'online' => FALSE,
          ],
          [
            'name' => 'NWDUG',
            'date' => '2020-05-12',
            'location' => 'Manchester, UK',
            'url' => 'http://nwdrupal.org.uk',
            'online' => TRUE,
          ],
          [
            'name' => 'Bay Area Drupal Camp (BADCamp)',
            'date' => '2020-10-14',
            'location' => NULL,
            'url' => 'https://2020.badcamp.org/session/tdd-test-driven-drupal',
            'online' => TRUE,
          ],
          [
            'name' => 'DrupalCon Europe 2020',
            'date' => '2020-12-08',
            'location' => NULL,
            'url' => 'https://events.drupal.org/europe2020/sessions/tdd-test-driven-drupal',
            'online' => TRUE,
          ],
        ],
      ],
    ]
  ];

  public function __construct(
    private ValidatesTheAccessToken $validateTheAccessToken,
  ) {}

  public function found(): Response {
    return new JsonResponse(self::$data, Response::HTTP_OK);
  }

  public function needsValidToken(Request $request): Response {
    if (!$token = $request->get('token')) {
      return new JsonResponse(['errors' => ['Access denied']], Response::HTTP_FORBIDDEN);
    }

    if (!($this->validateTheAccessToken)($token)) {
      return new JsonResponse(['errors' => ['Invalid token']], Response::HTTP_BAD_REQUEST);
    }

    return $this->found();
  }

  public function notFound(): Response {
    return new JsonResponse([], Response::HTTP_NOT_FOUND);
  }

}

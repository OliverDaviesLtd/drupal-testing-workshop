<?php

declare(strict_types=1);

namespace Drupal\legacy\Action;

interface ValidatesTheAccessToken {

  public function __invoke(string $token): bool;

}

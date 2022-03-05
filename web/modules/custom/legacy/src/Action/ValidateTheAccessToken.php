<?php

declare(strict_types=1);

namespace Drupal\legacy\Action;

final class ValidateTheAccessToken implements ValidatesTheAccessToken {

  public function __invoke(string $token): bool {
    if (!is_numeric($token)) {
      return FALSE;
    }

    // Token cannot be more than 5 characters.
    if (strlen($token) > 5) {
      return FALSE;
    }

    // Token must contain 5 unique characters.
    if (count(array_unique(str_split($token))) < 5) {
      return FALSE;
    }

    return TRUE;
  }

}

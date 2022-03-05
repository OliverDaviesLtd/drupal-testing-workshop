<?php

declare(strict_types=1);

namespace Drupal\legacy\Model;

use Drupal\node\NodeInterface;

interface ArticleInterface {

  public static function fromNode(NodeInterface $node): static;

}

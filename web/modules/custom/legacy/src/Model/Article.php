<?php

declare(strict_types=1);

namespace Drupal\legacy\Model;

use Drupal\node\NodeInterface;
use Webmozart\Assert\Assert;

final class Article implements ArticleInterface {

  public function __construct(
    private NodeInterface $node,
  ) {}

  public static function fromNode(NodeInterface $node): static {
    Assert::same(value: $node->bundle(), expect: 'article');

    return new static($node);
  }

  public function getTitle(): string {
    return $this->node->label();

  }
}

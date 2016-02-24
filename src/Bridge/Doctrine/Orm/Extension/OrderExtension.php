<?php

/*
 * This file is part of the API Platform Builder package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ApiPlatform\Core\Bridge\Doctrine\Orm\Extension;

use Doctrine\ORM\QueryBuilder;

/**
 * Applies selected ordering while querying resource collection.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @author Samuel ROZE <samuel.roze@gmail.com>
 */
class OrderExtension implements QueryCollectionExtensionInterface
{
    private $order;

    public function __construct(string $order = null)
    {
        $this->order = $order;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(QueryBuilder $queryBuilder, string $resourceClass, string $operationName = null)
    {
        $classMetaData = $queryBuilder->getEntityManager()->getClassMetadata($resourceClass);
        $identifiers = $classMetaData->getIdentifier();

        if (null !== $this->order) {
            foreach ($identifiers as $identifier) {
                $queryBuilder->addOrderBy('o.'.$identifier, $this->order);
            }
        }
    }
}

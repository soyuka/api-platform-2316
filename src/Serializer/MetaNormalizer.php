<?php

namespace App\Serializer;

use App\Entity\Dummy;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MetaNormalizer implements NormalizerInterface, NormalizerAwareInterface, CacheableSupportsMethodInterface {

    use NormalizerAwareTrait;
    private $normalizers;

    public function __construct($normalizers) {
        $this->normalizers = $normalizers;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $object->meta = 'foo';

        foreach ($this->normalizers as $normalizer) {
            if ($normalizer instanceof MetaNormalizer) {
                continue;
            }

            if ($normalizer->supportsNormalization($object, $format)) {
                return $normalizer->normalize($object, $format, $context);
            }
        }

        return $object;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Dummy;
    }
}

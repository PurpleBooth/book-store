<?php

namespace BookStoreContract\Normalizer;

use Joli\Jane\Runtime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class BookNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'BookStoreContract\\Model\\Book') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \BookStoreContract\Model\Book) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \BookStoreContract\Model\Book();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (property_exists($data, 'isbn')) {
            $object->setIsbn($data->{'isbn'});
        }
        if (property_exists($data, 'author')) {
            $object->setAuthor($data->{'author'});
        }
        if (property_exists($data, 'rrp')) {
            $object->setRrp($data->{'rrp'});
        }
        if (property_exists($data, 'title')) {
            $object->setTitle($data->{'title'});
        }
        if (property_exists($data, 'description')) {
            $object->setDescription($data->{'description'});
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getIsbn()) {
            $data->{'isbn'} = $object->getIsbn();
        }
        if (null !== $object->getAuthor()) {
            $data->{'author'} = $object->getAuthor();
        }
        if (null !== $object->getRrp()) {
            $data->{'rrp'} = $object->getRrp();
        }
        if (null !== $object->getTitle()) {
            $data->{'title'} = $object->getTitle();
        }
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }

        return $data;
    }
}

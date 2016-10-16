<?php

namespace BookStoreContract\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new \Joli\Jane\Runtime\Normalizer\ReferenceNormalizer();
        $normalizers[] = new \Joli\Jane\Runtime\Normalizer\ArrayDenormalizer();
        $normalizers[] = new StoredBookNormalizer();
        $normalizers[] = new BookNormalizer();

        return $normalizers;
    }
}

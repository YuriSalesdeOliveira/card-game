<?php

namespace Source\Domain\ValueObjects;

use DomainException;

final class Image
{
    private string $image;

    public function __construct(string $image)
    {
        $this->image = $image;
    }

    public function value(): string
    {
        return $this->image;
    }

    public static function parse(string $image): Image
    {
        self::validate($image);

        return new self($image);
    }

    private static function validate(string $image): void
    {
        if (! file_exists($image)) {

            throw new DomainException('This image does not exist.');
        }

        if (! self::isImage($image)) {

            throw new DomainException('Image is not valid.');
        }
    }

    private static function isImage(string $image): bool
    {
        if (! self::allowedImageTypes($image)) {
            return false;
        }

        $allowed_types = [
            IMAGETYPE_JPEG,
            IMAGETYPE_PNG,
            IMAGETYPE_GIF,
        ];

        $details = getimagesize($image);
        $image_type = $details[2];

        if (in_array($image_type, $allowed_types)) {
            return true;
        }

        return false;
    }

    private static function allowedImageTypes(string $image): bool
    {
        $allowed_types = [
            'jpeg',
            'jpg',
            'png',
            'gif',
        ];

        $image = explode('.', $image);

        if (in_array($image[1], $allowed_types)) {
            return true;
        }

        return false;
    }

    public function __toString(): string
    {
        return $this->image;
    }
}

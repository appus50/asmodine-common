<?php

namespace Asmodine\CommonBundle\Domain;

/**
 * Class Body.
 */
class Body extends AbstractSluggable
{
    const ANKLE = 'ankle';
    const ARM = 'arm'; // arm length
    const BICEP = 'bicep'; // arm turn
    const BRA = 'bra';
    const BUST_HEIGHT = 'bust_height';
    const BUST_SEPARATION = 'bust_separation';
    const CALF = 'calf';
    const CHEST = 'chest'; // bust or chest
    const CROTCH = 'crotch';
    const CROTCH_BACK = 'crotch_back';
    const CROTCH_FRONT = 'crotch_front';
    const FINGER = 'finger';
    const FOOT_LENGTH = 'foot_length';
    const FOOT_WIDTH = 'foot_width';
    const HAND_LENGTH = 'hand_length';
    const HAND_WIDTH = 'hand_width';
    const HEAD = 'head';
    const HEIGHT = 'height';
    const HIP_HEIGHT = 'hip_height';
    const HIP_HIGH = 'hip_high';
    const HIPS = 'hips';
    const INSEAM = 'inseam'; // Inside Leg
    const KNEE = 'knee';
    const LENGTH_BACK = 'length_back';
    const LENGTH_FRONT = 'length_front';
    const NECK = 'neck';
    const NECK_TO_FLOOR = 'neck_to_floor';
    const SHOULDER = 'shoulder';
    const SHOULDER_LENGTH = 'shoulder_length';
    const SHOULDER_TO_WAIST_BACK = 'shoulder_to_waist_back';
    const SHOULDER_TO_WAIST_FRONT = 'shoulder_to_waist_front';
    const THIGH = 'thigh';
    const WAIST = 'waist';
    const WAIST_TO_FLOOR = 'waist_to_floor';
    const WAIST_TO_HIPS_BACK = 'waist_to_hips_back';
    const WAIST_TO_HIPS_FRONT = 'waist_to_hips_front';
    const WIDTH_BACK = 'width_back';
    const WIDTH_FRONT = 'width_front';
    const WRIST = 'wrist';

    /**
     * Get all slugs of body.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::ANKLE,
            self::ARM,
            self::BICEP,
            self::BRA,
            self::BUST_HEIGHT,
            self::BUST_SEPARATION,
            self::CALF,
            self::CHEST,
            self::CROTCH,
            self::CROTCH_BACK,
            self::CROTCH_FRONT,
            self::FINGER,
            self::FOOT_LENGTH,
            self::FOOT_WIDTH,
            self::HAND_LENGTH,
            self::HAND_WIDTH,
            self::HEAD,
            self::HEIGHT,
            self::HIP_HEIGHT,
            self::HIP_HIGH,
            self::HIPS,
            self::INSEAM,
            self::KNEE,
            self::LENGTH_BACK,
            self::LENGTH_FRONT,
            self::NECK,
            self::NECK_TO_FLOOR,
            self::SHOULDER,
            self::SHOULDER_LENGTH,
            self::SHOULDER_TO_WAIST_BACK,
            self::SHOULDER_TO_WAIST_FRONT,
            self::THIGH,
            self::WAIST,
            self::WAIST_TO_FLOOR,
            self::WAIST_TO_HIPS_BACK,
            self::WAIST_TO_HIPS_FRONT,
            self::WIDTH_BACK,
            self::WIDTH_FRONT,
            self::WRIST,
        ];
    }

    /**
     * Get 2D measurement only.
     *
     * @return array
     */
    public static function get2DMeasurementSlugs(): array
    {
        return [
            self::ARM,
            self::BUST_HEIGHT,
            self::BUST_SEPARATION,
            self::FOOT_LENGTH,
            self::FOOT_WIDTH,
            self::HAND_LENGTH,
            self::HAND_WIDTH,
            self::HEIGHT,
            self::HIP_HEIGHT,
            self::INSEAM,
            self::NECK_TO_FLOOR,
            self::SHOULDER,
            self::SHOULDER_LENGTH,
            self::WAIST_TO_FLOOR,
            self::WIDTH_BACK,
        ];
    }

    /**
     * Get 3D measurement only.
     *
     * @return array
     */
    public static function get3DMeasurementSlugs(): array
    {
        return [
            self::ANKLE,
            self::BICEP,
            self::BRA,
            self::CALF,
            self::CHEST,
            self::CROTCH,
            self::CROTCH_BACK,
            self::CROTCH_FRONT,
            self::FINGER,
            self::HEAD,
            self::HIP_HIGH,
            self::HIPS,
            self::KNEE,
            self::LENGTH_BACK,
            self::LENGTH_FRONT,
            self::NECK,
            self::SHOULDER_TO_WAIST_BACK,
            self::SHOULDER_TO_WAIST_FRONT,
            self::THIGH,
            self::WAIST,
            self::WAIST_TO_HIPS_BACK,
            self::WAIST_TO_HIPS_FRONT,
            self::WIDTH_FRONT,
            self::WRIST,
        ];
    }
}

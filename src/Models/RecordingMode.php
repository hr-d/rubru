<?php


namespace HRD\Rubru\Models;

class RecordingMode
{
    const RECORDING_MODE_MANUAL = "MANUAL";
    const RECORDING_MODE_NEVER = "NEVER";
    const RECORDING_MODE_ALWAYS = "ALWAYS";
    const RECORDING_MODE_ALWAYS_WITH_CONTROL = "ALWAYS_WITH_CONTROL";

    public static function get_recordingModes()
    {
        return [
            self::RECORDING_MODE_MANUAL,
            self::RECORDING_MODE_NEVER,
            self::RECORDING_MODE_ALWAYS,
            self::RECORDING_MODE_ALWAYS_WITH_CONTROL,
        ];
    }

    public static function check(string $recordingModeName)
    {
        if (in_array($recordingModeName, Self::get_recordingModes())) {
            return true;
        }
        return false;
    }
}

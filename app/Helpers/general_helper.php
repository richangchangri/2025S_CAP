<?php

function generate_string($char = "", $strength = 16)
{
	if (!empty($input)) {
		$input = $char;
	} else {
		$input = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
	}

	$input_length = strlen($input);
	$random_string = '';
	for ($i = 0; $i < $strength; $i++) {
		$random_character = $input[mt_rand(0, $input_length - 1)];
		$random_string .= $random_character;
	}

	return $random_string;
}

if (!function_exists('calculate_actual_usage')) {
    function calculate_actual_usage(string $startTime, string $endTime): string
    {
        $start = new DateTime($startTime);
        $end = new DateTime($endTime);
        $interval = $start->diff($end);
		$totalMinutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
        return $totalMinutes;
    }
}

if (!function_exists('generateUUIDv4')) {
	function generateUUIDv4()
	{
		return sprintf(
			'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), // 32 bits for "time_low"
			mt_rand(0, 0xffff), // 16 bits for "time_mid"
			mt_rand(0, 0x0fff) | 0x4000, // 16 bits for "time_hi_and_version"
			mt_rand(0, 0x3fff) | 0x8000, // 16 bits for "clk_seq_hi_res"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff) // 48 bits for "node"
		);
	}

}

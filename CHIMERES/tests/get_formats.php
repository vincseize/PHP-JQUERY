<?php 

namespace PHPVideoToolkit;

// https://github.com/buggedcom/phpvideotoolkit-v2


// --------

// $finfo = finfo_open(FILEINFO_MIME_TYPE);

// echo finfo_file($finfo, "VinceNoVince.mp4");
// finfo_close($finfo);

// $finfo = finfo_open(FILEINFO_MIME_TYPE);
// echo finfo_file($finfo, "file_example_MP4_480_1_5MG.mp4");
// finfo_close($finfo);

// echo "<br>";

// --------

// require_once '../phpvideotoolkit-v2/src/PHPVideoToolkit/Video.php';
// require_once '../phpvideotoolkit-v2/src/PHPVideoToolkit/Media.php';

// use phpvideotoolkit\src\Video;
// $PHPVideoToolkit = new PHPVideoToolkit();

// --------

echo "processing...";


include_once '..'.DIRECTORY_SEPARATOR.'phpvideotoolkit-v2'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

$ffmpeg_dir = "C:\\ffmpeg\\bin\\";
$config = new Config(array(
	'temp_directory' => '..\\tmp',
	'ffmpeg' => $ffmpeg_dir.'ffmpeg',
	'ffprobe' => $ffmpeg_dir.'ffprobe',
	// 'yamdi' => '/opt/local/bin/yamdi',
	// 'qtfaststart' => '/opt/local/bin/qt-faststart',
	// 'cache_driver' => 'InTempDirectory',
), true);

$video  = new Video('test.mp4');
$process = $video->extractFrame(new Timecode(1))
				->save('test_frame_0001.jpg');
$output = $process->getOutput();

echo "DONE";

exit;

?>

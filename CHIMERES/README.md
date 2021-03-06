# BOOKFOLIO V2
Portfolio Galleries crud without database

...is a set of PHP classes aimed to provide a modular, object oriented and accessible interface for interacting with videos and audio through FFmpeg.

BOOKFOLIO also provides FFmpeg-PHP emulation in pure PHP so you wouldn't need to compile and install the FFmpeg-PHP module, you only require FFmpeg and BOOKFOLIO. As FFmpeg-PHP has not been updated since 2007 using FFmpeg-PHP with a new version of FFmpeg can often break FFmpeg-PHP. Using PHPVideoToolkits' emulation of FFmpeg-PHP's functionality allows you to upgrade FFmpeg without worrying about breaking functionality of provided through the FFmpeg-PHP API.

**IMPORTANT** BOOKFOLIO has only been tested with v1.1.2 of FFmpeg. Whilst the majority of functionality should work regardless of your version of FFmpeg I cannot guarantee it. If you find a bug or have a patch please open a ticket or submit a pull request on https://github.com/buggedcom/phpvideotoolkit-v2

### Table of Contents

- [Usage](#usage)
- [Install BOOKFOLIO](#install-bookfolio)
- [BOOKFOLIO Output Formats](#bookfolio-output-formats)
- [Configuration](#configuration)
- [Resizing Video and Images](#resizing-video-and-images)
- [License](#license)
- [Documentation](#documentation)
- [Latest Changes](#latest-changes)

## Usage

Whilst the extensive documentation covers just about everything (to be honest there are only a few pages in the documentation as I'm too busy to write too much of it - but the examples below are pretty good), here are a few examples of what you can do.
- take a look at /uploadForm/README.md

### Install BOOKFOLIO

- php GD required
- FFMPEG required
- BLUEIMP :
- take a look at /BlueImp/README.md
- chmod -R 777 /BlueImp/server/php/files (check that), normally done in php.ini
- remove or rename .htaccessDES /BlueImp/server/php/files/.htaccess on Linux Server ! IMPORTANT
- PHPVIDEOTOOLKIT-V2 :
- install phpvideotoolkit-v2 in root folder.
- -> /phpvideotoolkit-v2
```bash 
composer updade
```
- -> replace /phpvideotoolkit-v2 files, with my

### Configuration
- login/password $logins array in login.php
- ini.php
- post_max_size etc..., /BlueImp/server/phph/php.ini

### BOOKFOLIO Output Formats

BOOKFOLIO accept 
`AudioFormat`, `VideoFormat` and `ImageFormat`. 

_Audio_

- `AudioFormat_Acc`
- `AudioFormat_Flac`
- `AudioFormat_Mp3`
- `AudioFormat_Oga`
- `AudioFormat_Wav`

_Image_

- `ImageFormat_Gif`
- `ImageFormat_Jpeg`
- `ImageFormat_Png`
- `ImageFormat_Ppm`

_Video_

- `VideoFormat_3gp`
- `VideoFormat_Flv`
- `VideoFormat_H264`
- `VideoFormat_Mkv`
- `VideoFormat_Mp4`
- `VideoFormat_Ogg`
- `VideoFormat_Webm`
- `VideoFormat_Wmv`
- `VideoFormat_Wmv3`

To check _Audio_, _Image_, _Video_
-> tests/get_formats.php todo

### Resizing Video and Images

Todo doc
- blueImp side folder for upload, and copy files in 'real' galleries

## License

BOOKFOLIO Copyright (c) 2018-2020 Charles POTTIER

DUAL Licensed under MIT and GPL v2

See LICENSE.md for more details.

## Documentation

- todo
- uploadForm/index.php : require('UploadHandler.php');
send $gallery from uploadForm/js/demo.js button, url: 'server/php/index.php?g='+gallery
- path uploadForm file upload : uploadForm/UploadHandler.php ->public function __construct

## Latest Changes

**[1.9.0-beta]** [09.11.2020]

WARNING: Potential ... todo

todo
[Full changelog](https://github.com/buggedcom/phpvideotoolkit-v2/blob/master/CHANGELOG.md)

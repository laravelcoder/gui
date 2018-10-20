#!/bin/bash
#use: $ shrink.sh source_file dest_file
ffmpeg -y -i ${1} -s 512x288 -b:v 512k -vcodec libx264 -flags +loop+mv4 -movflags faststart -cmp 256 -partitions +parti4x4+parti8x8+partp4x4+partp8x8 -subq 6 -trellis 0 -refs 5 -bf 0 -coder 0 -me_range 16 -g 250 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -qmin 10 -qmax 51 -qdiff 4 -c:a aac -strict -2 -ac 1 -ar 16000 -r 13 -ab 64000 -aspect 16:9 ${2}

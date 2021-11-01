#!/bin/bash
cd ..
DIRNAME=$(pwd)
docker run --rm -v $(pwd):/opt/projet --name projet -u 1000:1000 php/symfony:projet symfony new skeleton --full
shopt -s dotglob
mv skeleton/* $DIRNAME
rm -rf skeleton